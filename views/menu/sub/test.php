<?php
	/**
	 * @var string $activeMenu2
	 */
?>
<li class="nav-item">
	<a class="nav-link<?= $activeMenu2==='test' ? ' active' : '' ?>" href="<?= $this->genUrl('test.test') ?>">
		Test2
	</a>
</li>
