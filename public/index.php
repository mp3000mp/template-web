<?php

use App\App;
    use DebugBar\StandardDebugBar;
    use DI\ContainerBuilder;
use Symfony\Component\Dotenv\Dotenv;


// autoload
require(__DIR__.'/../vendor/autoload.php');


// constants
define('BASE_FOLDER', __DIR__.'/../');
define('CONFIG_FOLDER', BASE_FOLDER.'config/');
define('PUBLIC_FOLDER', BASE_FOLDER.'public/');
define('ASSET_FOLDER', PUBLIC_FOLDER.'build/');
define('VIEW_FOLDER', BASE_FOLDER.'views/');


// load env
$dotenv = new Dotenv();
$dotenv->load(__DIR__.'/../.env', __DIR__.'/../.env.local');
define('ENV', $_ENV['ENV']);


// DI
$containerBuilder = new ContainerBuilder();
$containerBuilder->addDefinitions(CONFIG_FOLDER.'di.php');
$container = $containerBuilder->build();


// handle request
$container->call([App::class, 'run']);
