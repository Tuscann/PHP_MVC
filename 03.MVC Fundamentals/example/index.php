<?php
session_start();

spl_autoload_register(function($class) {
    $class = str_replace('\\', '/', $class);
    require_once $class . '.php';
});

$selfFolder = str_replace("index.php", "", $_SERVER['PHP_SELF']);
$uri = str_replace($selfFolder, "", $_SERVER['REQUEST_URI']);
$uriParts = explode("/", $uri);
$controllerName = array_shift($uriParts);
$methodName = array_shift($uriParts);
$controllerFullName =
    'Controllers\\'
    .
    ucfirst($controllerName)
    .
    'Controller';

$mvcContext = new \Core\MVCContext($controllerName, $controllerFullName, $methodName, $uri, $uriParts, $_SERVER['REQUEST_URI']);
$request = new \Core\Http\Components\Request\Request($_SERVER);
$session = new \Core\Http\Components\Session\Session($_SESSION, function() { session_destroy(); });
$app = new \Core\Application($mvcContext, $request, $session);
$app->addDependency(\Core\ViewInterface::class, \Core\View::class);
$app->addResolvedDependency(\Core\MVCContextInterface::class, $mvcContext);
$app->addResolvedDependency(\Core\Http\Components\Request\RequestInterface::class, $request);
$app->addResolvedDependency(\Core\Http\Components\Session\SessionInterface::class, $session);
$app->start();

