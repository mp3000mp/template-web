<?php
	/**
	 * @var string $activeMenu
     * @var string $subMenu
     * @var string $activeMenu2
	 */
?>
<header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navCollapse" aria-controls="navCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navCollapse">
                <div class="navbar-nav mr-auto flex-column">
                    <ul class="navbar-nav" id="nav1">
                        <li class="nav-item">
                            <a class="nav-link" href="<?= $this->genUrl('home') ?>">
                                <i title="<?= $this->trans('menu.home') ?>" class="fa fa-home"></i>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link<?= $activeMenu==='test' ? ' active' : '' ?>" href="<?= $this->genUrl('test') ?>">
                                Test
                            </a>
                        </li>
                    </ul>
                    <ul class="navbar-nav flex-lg-row" id="nav2">
                        <?php if($subMenu !== ''){
                            $this->insert("menu/sub/$subMenu", ['activeMenu2' => $activeMenu2]);
                        } ?>
                    </ul>
                </div>
                <ul class="navbar-nav navbar-right" id="nav3">
                    <li class="nav-item dropdown">
                        <ul id="flags">
                            <li class="mx-3 mx-lg-1"><a href="<?= $this->genUrl('lang', ['lang' => 'en']) ?>" title="English"><img src="/img/app/flags/en.png" alt="en"></a></li>
                            <li class="mx-3 mx-lg-1"><a href="<?= $this->genUrl('lang', ['lang' => 'fr']) ?>" title="Français"><img src="/img/app/flags/fr.png" alt="fr"></a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" title="<?= $this->trans('menu.my_account') ?>" href="/profile"><?= $this->trans('menu.my_account') ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" title="<?= $this->trans('menu.log_out') ?>" href="/logout"><i class="fa fa-sign-out-alt"></i></a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>
