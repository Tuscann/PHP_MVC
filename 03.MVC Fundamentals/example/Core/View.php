<?php


namespace Core;


use Core\Http\Components\Session\SessionInterface;

class View implements ViewInterface
{
    const VIEWS_FOLDER = 'Views';
    const VIEWS_EXTENSION = '.php';

    /**
     * @var MVCContextInterface
     */
    private $mvcContext;

    /**
     * @var SessionInterface
     */
    private $session;


    public function __construct(MVCContextInterface $mvcContext,
                                SessionInterface $session)
    {
        $this->mvcContext = $mvcContext;
        $this->session = $session;
    }


    public function render($viewName = null, $model = null)
    {
        if ($viewName == null || is_object($viewName)) {
            $model = $viewName;
            $viewName = $this->mvcContext->getControllerName()
                . DIRECTORY_SEPARATOR
                . $this->mvcContext->getAction();
        }

        include self::VIEWS_FOLDER
            .
            DIRECTORY_SEPARATOR
            .
            $viewName
            .
            self::VIEWS_EXTENSION;
    }

    public function url($controllerName, $actionName, ...$args)
    {
        $controller = $this->mvcContext->getControllerName();
        $action = $this->mvcContext->getAction();
        $fullUri = $this->mvcContext->getFullUri();
        $folders = str_replace('/'.$controller . '/' . $action, '', $fullUri);

        $url = $folders . '/' . $controllerName . '/' . $actionName;
        if (!empty($args)) {
            $url .= '/' . implode('/', $args);
        }

        return $url;
    }

    public function getMessages($key)
    {
        $messages = $this->session->getMessage($key);

        return $messages;
    }
}