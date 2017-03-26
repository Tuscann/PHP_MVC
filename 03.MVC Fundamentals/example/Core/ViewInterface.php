<?php


namespace Core;


interface ViewInterface
{
    public function render($viewName = null, $model = null);

    public function url($controllerName, $actionName, ...$args);

    public function getMessages($key);
}