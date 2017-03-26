<?php
/**
 * @var \SoftUni\Core\ViewInterface $this
 * @var \SoftUni\Models\View\UserProfileViewModel $model
 */
?>

<h1>Welcome, <?= $model->getUsername(); ?></h1>

<a href="<?=$this->url("users", "profileEdit", [$model->getId()]);?>">Edit your profile</a>
