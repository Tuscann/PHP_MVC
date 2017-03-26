<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Test Drive</title>
    <style>
        body {
            background-color: green;
        }

        h1 {
            color: maroon;
            margin-left: 40px;
        }

        .myClass {
            color: red;
        }
    </style>
</head>
<body>
<div><h1>Kamen</h1></div>
The small element now refers to "small print."
<p class=myClass> Start the reactor.</p>
<h2> To-Do List </h2>
<ul contenteditable="true">
    <li> Break mechanical cab driver.</li>
    <li> Drive to abandoned factory
    <li> Watch video of self</li>
</ul>
<form method="get">
    <label for="email">Email:</label>
    <input id="email" name="email" type="email"/>
    <button type="submit"> Submit Form</button>
</form>
<?php


if (isset($_GET['submit'])){
    $email = $_GET['email'];

    echo $email;
}



?>

</body>



</html>