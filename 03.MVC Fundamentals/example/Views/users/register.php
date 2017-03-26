<?php /** @var $model \Models\RegisterViewModel
 * @var $this \Core\ViewInterface
 */
?>

<h1>Title: <?=$model->getTitle(); ?></h1>

<?php foreach ($this->getMessages('error') as $message): ?>
    <h1 style="color:red"><?=$message;?></h1>
<?php endforeach; ?>

<form method="post" action="<?=$this->url("users", "registerProcess", "gosho", 34);?>">
    Username: <input type="text" name="username"/><br/>
    Password: <input type="text" name="password"/><br/>
    Confirm: <input type="text" name="confirmPassword"><br/>
    <input type="submit" value="Register!"/>
</form>
