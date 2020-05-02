<?php

	$title = $title ?? 'template';
	$activeMenu = $activeMenu ?? '';
	$subMenu = $subMenu ?? '';
	$activeMenu2 = $activeMenu2 ?? '';

?>
<!DOCTYPE html>
<html lang="fr">
<head>
	<title><?= $this->e($title) ?></title>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <link rel="icon" href="/img/favicon.png" />

    <script type="text/javascript" src="/build/bundle.js"></script>

    <?php if(ENV !== 'prod'){
        echo $this->renderDebugBarAssets();
    } ?>

</head>
<body>
    <?php $this->insert('menu/main', [
            'activeMenu' => $activeMenu ?? '',
            'subMenu' => $subMenu ?? '',
            'activeMenu2' => $activeMenu2 ?? '',
    ]) ?>
    <main>
	    <?= $this->section('content') ?>
    </main>
    <?php $this->insert('layout/footer') ?>
    <?php if(ENV !== 'prod'){
        echo $this->renderDebugBar();
    } ?>
</body>
</html>
