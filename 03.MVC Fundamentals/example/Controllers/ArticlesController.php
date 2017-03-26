<?php
namespace Controllers;

class ArticlesController
{
    public function add($title, $body)
    {
        echo "<h1>аз добавям статии $title и $body</h1>";
    }
}