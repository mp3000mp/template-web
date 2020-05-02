<?php
/**
* @var string $msg
 */
?>

<?php $this->layout('base', [
	'title' => 'Home page',
]) ?>

<div class="container">
    <h1><?= $this->trans('menu.home') ?></h1>

    <p><?= $this->trans('msg') ?></p>
</div>
