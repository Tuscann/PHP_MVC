<?php /** @var \SoftUni\Core\ViewInterface $this */ ?>
<div class="container">
    <div class="well bs-component">
        <form class="form-horizontal" method="post" action="<?= $this->url("users", "loginPost", []) ;?>">
            <fieldset>
                <legend>Login</legend>
                <div class="form-group">
                    <label for="inputUsername" class="col-lg-2 control-label">Username</label>
                    <div class="col-lg-10">
                        <input class="form-control" name="username" id="inputUsername" placeholder="Username" type="text">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputPassword" class="col-lg-2 control-label">Password</label>
                    <div class="col-lg-10">
                        <input class="form-control" name="password" id="inputPassword" placeholder="Password" type="password">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-lg-10 col-lg-offset-2">
                        <button name="login" type="submit" class="btn btn-primary">Login</button>
                    </div>
                </div>
            </fieldset>
        </form>
    </div>
</div>
