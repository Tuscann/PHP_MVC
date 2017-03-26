<?php
/**
 * @var $this \SoftUni\Core\ViewInterface
 * @var $model \SoftUni\Models\View\UserProfileEditViewModel
 */
?>
<div class="container">
    <div class="well bs-component">
        <form class="form-horizontal" method="post" action="<?= $this->url("users", "profileEditPost", [$model->getId()]);?>">
            <fieldset>
                <legend>Edit your profile</legend>
                <div class="form-group">
                    <label for="inputUsername" class="col-lg-2 control-label">Username</label>
                    <div class="col-lg-10">
                        <input class="form-control" value="<?=$model->getUsername();?>" name="username" id="inputUsername" placeholder="Username" type="text">
                    </div>
                </div>
                <?php if(!$model->isForeignEdit()): ?>
                    <div class="form-group">
                        <label for="inputPassword" class="col-lg-2 control-label">Password</label>
                        <div class="col-lg-10">
                            <input class="form-control" value="<?=$model->getPassword();?>" name="password" id="inputPassword" placeholder="Password" type="password">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputPasswordConfirm" class="col-lg-2 control-label">Confirm</label>
                        <div class="col-lg-10">
                            <input class="form-control" name="confirmPassword" id="inputPasswordConfirm" placeholder="Password" type="password">
                        </div>
                    </div>
                <?php endif; ?>
                <div class="form-group">
                    <label for="inputEmail" class="col-lg-2 control-label">Email</label>
                    <div class="col-lg-10">
                        <input class="form-control" value="<?=$model->getEmail();?>" name="email" id="inputEmail" placeholder="Email" type="text">
                    </div>
                </div>
                <div class="form-group">
                    <label for="birthday" class="col-lg-2 control-label">Birthday</label>
                    <div class="col-lg-10">
                        <input class="form-control" value="<?=$model->getBirthday();?>" name="birthday" id="birthday" placeholder="Birthday" type="text">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-lg-10 col-lg-offset-2">
                        <button type="reset" class="btn btn-default">Cancel</button>
                        <button name="edit" type="submit" class="btn btn-primary">Edit</button>
                    </div>
                </div>
            </fieldset>
        </form>
    </div>
</div>