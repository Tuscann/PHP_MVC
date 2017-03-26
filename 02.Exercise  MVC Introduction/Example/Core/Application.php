<?php
namespace SoftUni\Core;

use SoftUni\Core\MVC\MVCContextInterface;

class Application
{
    const VENDOR_NAMESPACE = 'SoftUni';
    const CONTROLLERS_NAMESPACE = 'Controllers';
    const CONTROLLERS_SUFFIX = 'Controller';
    const NAMESPACE_SEPARATOR = '\\';

    private $mvcContext;

    private $dependencies = [];
    private $resolvedDependencies = [];

    public function __construct(MVCContextInterface $mvcContext)
    {
        $this->mvcContext = $mvcContext;
    }

    public function start()
    {
        $controllerName = $this->mvcContext->getController();

        $controllerFullQualifiedName =
            self::VENDOR_NAMESPACE
            . self::NAMESPACE_SEPARATOR
            . self::CONTROLLERS_NAMESPACE
            . self::NAMESPACE_SEPARATOR
            . ucfirst($controllerName)
            . self::CONTROLLERS_SUFFIX;

        $actionName = $this->mvcContext->getAction();
        $args = $this->mvcContext->getArguments();

        $refMethod = new \ReflectionMethod($controllerFullQualifiedName, $actionName);
        $parameters = $refMethod->getParameters();
        foreach ($parameters as $parameter) {
            $parameterClass = $parameter->getClass();
            if ($parameterClass !== null) {
                $className = $parameterClass->getName();
                if (!$parameterClass->isInterface()) {
                    $instance = $this->mapForm($_POST, $parameterClass);
                } else {
                    $instance = $this->resolve($this->dependencies[$className]);
                }
                $args[] = $instance;
            }
        }

        if (class_exists($controllerFullQualifiedName)) {
            $controller = new $controllerFullQualifiedName();
            call_user_func_array(
                [
                    $controller,
                    $actionName
                ],
                $args
            );
        }
    }

    public function registerDependency($interfaceName, $implementationName)
    {
        $this->dependencies[$interfaceName] = $implementationName;
    }

    public function addClass($interfaceName, $instance)
    {
        $implementationName = get_class($instance);
        $this->dependencies[$interfaceName] = $implementationName;
        $this->resolvedDependencies[$implementationName] = $instance;
    }

    private function resolve($className)
    {
        $refClass = new \ReflectionClass($className);
        $constructor = $refClass->getConstructor();
        if ($constructor === null) {
            $instance = new $className();
            return $instance;
        }

        $parameters = $constructor->getParameters();
        $parametersToInstantiate = [];
        foreach ($parameters as $parameter) {
            $interface = $parameter->getClass();
            if ($interface === null) {
                throw new \Exception("Parameters cannot be primitive in order the DI to work");
            }

            $interfaceName = $interface->getName();

            $implementation = $this->dependencies[$interfaceName];
            if (array_key_exists($implementation, $this->resolvedDependencies)) {

                $implementationInstance = $this->resolvedDependencies[$implementation];
            } else {
                $implementationInstance = $this->resolve($implementation);
                $this->resolvedDependencies[$implementation] = $implementationInstance;
            }

            $parametersToInstantiate[] = $implementationInstance;
        }
        $result = $refClass->newInstanceArgs($parametersToInstantiate);
        $this->resolvedDependencies[$className] = $result;

        return $result;
    }

    private function mapForm($form, \ReflectionClass $parameterClass)
    {
        $className = $parameterClass->getName();
        $instance = new $className();
        foreach ($parameterClass->getProperties() as $field) {
            $field->setAccessible(true);
            if (array_key_exists($field->getName(), $form)) {
                $field->setValue($instance, $form[$field->getName()]);
            }
        }

        return $instance;
    }
}