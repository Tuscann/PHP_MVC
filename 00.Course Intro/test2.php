<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Untitled Document</title>
</head>

<body>
<form id="form1" name="form1" method="get" action="">
    <label>Please type in a message
        <input type="text" name="msg" id="msg" />
    </label>
    <label>and your name
        <input type="text" name="name" id="name" />
    </label>

    <p>
        <label>Submit
            <input type="submit" name="submit" id="submit" value="Submit" />
        </label>
    </p>
</form>

<?php
if (isset($_GET['submit'])){
    $msg = $_GET["msg"];
    $name = $_GET["name"]."\n";
    $posts = file_get_contents("posts.txt");
    echo gettype($posts);

    $posts = "$msg - $name\n" . $posts;
    file_put_contents("posts.txt", $posts);
    echo $posts;
}


?>

</body>
</html>