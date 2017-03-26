<?php
namespace SoftUni\Core;

interface ViewInterface
{
    public function render($viewName = null, $model = null);

    public function url($controller, $action, $params = []);
}