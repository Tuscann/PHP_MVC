<?php
namespace SoftUni\Core\MVC;


class MVCContext implements MVCContextInterface
{
    private $controller;

    private $action;

    private $uriJunk;

    private $arguments = [];

    /**
     * MVCContext constructor.
     * @param $controller
     * @param $action
     * @param $uriJunk
     * @param array $arguments
     */
    public function __construct(string $controller, string $action, string $uriJunk, array $arguments = [])
    {
        $this->controller = $controller;
        $this->action = $action;
        $this->uriJunk = $uriJunk;
        $this->arguments = $arguments;
    }

    /**
     * @return string
     */
    public function getController(): string
    {
        return $this->controller;
    }

    /**
     * @param string $controller
     */
    public function setController(string $controller)
    {
        $this->controller = $controller;
    }

    /**
     * @return string
     */
    public function getAction(): string
    {
        return $this->action;
    }

    /**
     * @param string $action
     */
    public function setAction(string $action)
    {
        $this->action = $action;
    }

    /**
     * @return string
     */
    public function getUriJunk(): string
    {
        return $this->uriJunk;
    }

    /**
     * @param string $uriJunk
     */
    public function setUriJunk(string $uriJunk)
    {
        $this->uriJunk = $uriJunk;
    }

    /**
     * @return array
     */
    public function getArguments(): array
    {
        return $this->arguments;
    }

    /**
     * @param array $arguments
     */
    public function setArguments(array $arguments)
    {
        $this->arguments = $arguments;
    }




}