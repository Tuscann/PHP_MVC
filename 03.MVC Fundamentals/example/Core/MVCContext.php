<?php


namespace Core;


class MVCContext implements MVCContextInterface
{
    private $controllerName;

    private $controllerFullName;

    private $action;

    private $uri;

    private $fullUri;

    private $args;


    public function __construct($controllerName, $controllerFullName, $action, $uri, $args, $fullUri)
    {
        $this->controllerName = $controllerName;
        $this->controllerFullName = $controllerFullName;
        $this->action = $action;
        $this->uri = $uri;
        $this->args = $args;
        $this->fullUri = $fullUri;
    }

    public function getControllerName()
    {
        return $this->controllerName;
    }

    public function getControllerFullName()
    {
        return $this->controllerFullName;
    }

    public function getAction()
    {
        return $this->action;
    }

    public function getURI()
    {
        return $this->uri;
    }

    public function getArgs(): array
    {
        return $this->args;
    }

    public function getFullUri()
    {
        return $this->fullUri;
    }


}