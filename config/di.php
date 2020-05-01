<?php

use App\Service\Renderer\RouterExtension;
use App\Service\Renderer\TranslatorExtension;
use Noodlehaus\Config;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use League\Plates\Engine;
use Symfony\Component\Translation\Loader\YamlFileLoader;
use Symfony\Component\Translation\Translator;
use function DI\get;
use function DI\autowire;
use function DI\value;

return [
	// aliases
	'config' => get( Config::class),
	'renderer' => get(Engine::class),
	'request' => get( Request::class),
	'router' => get(AltoRouter::class),
	'translator' => get( Translator::class),
	
	// router
	AltoRouter::class => function(Config $config)
	{
		$router = new AltoRouter();
		$routesConfig = include CONFIG_FOLDER."routes.php";
		$config->set('app.routes', $routesConfig);
		foreach ($routesConfig as $scope => $routes){
			foreach ($routes as $routeName => $routeParams){
				$router->map( $routeParams[0], $routeParams[1], $routeParams[2], $routeName);
			}
		}
		return $router;
	},
	
	// config
	Config::class => function()
	{
		$config = new Config(CONFIG_FOLDER.'config.yml');
		return $config;
	},
	
	// renderer
	Engine::class => function(AltoRouter $router, Translator $translator)
	{
		$engine = new League\Plates\Engine(VIEW_FOLDER);
		$engine->loadExtension(new RouterExtension($router));
		$engine->loadExtension(new TranslatorExtension($translator));
		//$engine->loadExtension(new League\Plates\Extension\Asset(ASSET_FOLDER, true));
		return $engine;
	},
	
	// request
	Request::class => function()
	{
		$request = Request::createFromGlobals();
		$request->setSession(new Session());
		return $request;
	},
	
	// translator
	Translator::class => function(Config $config, Request $request)
	{
		$langs = $config->get('langs');
		$currentLang = $request->getSession()->get('lang', $langs[0]);
		$translator = new Translator($currentLang);
		$translator->addLoader('yaml', new YamlFileLoader());
		$translator->setFallbackLocales(['en']);
		foreach ($langs as $lang){
			$translator->addResource('yaml', CONFIG_FOLDER."translations/main.$lang.yml", $lang);
		}
		$translator->setLocale($currentLang);
		return $translator;
	}
	
];
