<?php /** @var $model Models\LoginViewModel */ ?>


<h3>Потребители: <?=$model->getAllUsers();?> от тях активни: <?=$model->getActiveUsers();?></h3>
<form>
    Username: <input type="text"><br/>
    Password <input type="password"/><br/>
    <input type="submit" value="Login"/>
</form>