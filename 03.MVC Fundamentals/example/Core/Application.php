<?php


namespace Core;


use Core\Exceptions\FormValidationException;
use Core\Http\Components\Request\RequestInterface;
use Core\Http\Components\Session\SessionInterface;
use ReflectionMethod;

class Application
{
    /**
     * @var MVCContextInterface
     */
    private $mvcContext;

    /**
     * @var RequestInterface
     */
    private $request;

    private $session;

    private $dependencies;

    private $resolvedDependencies;

    public function __construct(MVCContextInterface $mvcContext,
                                RequestInterface $request,
                                SessionInterface $session)
    {
        $this->mvcContext = $mvcContext;
        $this->request = $request;
        $this->session = $session;
        $this->dependencies = [];
        $this->resolvedDependencies = [];
    }

    public function start()
    {
        $controllerFullName = $this->mvcContext->getControllerFullName();
        $methodName = $this->mvcContext->getAction();
        $uriParts = $this->mvcContext->getArgs();

        $controller = new $controllerFullName();
        $refM = new ReflectionMethod($controller, $methodName);
        foreach ($refM->getParameters() as $parameter) {
            if ($parameter->getClass() == null) {
                continue;
            }
            $className = $parameter->getClass()->getName();
            $obj = null;
            if (array_key_exists($className, $this->dependencies)) {
                $obj = $this->tryInstantiateDependency($className);
            } else {
                $obj = new $className();
                $this->mapFormData($_POST, $obj);
            }

            $position = $parameter->getPosition();
            $inserted = [$obj];
            array_splice($uriParts, $position, 0, $inserted);
        }

        call_user_func_array(
            [$controller,$methodName],
            $uriParts
        );
    }

    public function addDependency($abstraction, $implementation)
    {
        $this->dependencies[$abstraction] = $implementation;
    }

    public function addResolvedDependency($abstraction, $object)
    {
        $this->resolvedDependencies[$abstraction] = $object;
        $implementationClassName = get_class($object);
        $this->addDependency($abstraction, $implementationClassName);
    }

    public function resolve($className)
    {
        $classInfo = new \ReflectionClass($className);
        $constructor = $classInfo->getConstructor();
        if ($constructor == null) {
            return new $className();
        }

        $parameters = $constructor->getParameters();
        $instantiatedParameters = [];
        foreach ($parameters as $parameter) {
            $parameterInterfaceName = $parameter->getClass()->getName();
            $parameterInstance = $this->tryInstantiateDependency($parameterInterfaceName);
            $this->addResolvedDependency($parameterInterfaceName, $parameterInstance);
            $instantiatedParameters[] = $parameterInstance;
        }

        $instance = $classInfo->newInstanceArgs($instantiatedParameters);

        return $instance;
    }

    private function mapFormData($formData, $bindingModel)
    {
        $classInfo = new \ReflectionClass($bindingModel);
        foreach ($formData as $paramName => $value) {
            $property = $classInfo->getProperty($paramName);
            if ($property == null) {
                continue;
            }
            $propertyName = $property->getName();
            if (substr($propertyName, 0, 2) == 'is' && ctype_upper($propertyName[2])) {
                $propertyName = substr($propertyName, 2);
            }

            $setterMethod = 'set' . ucfirst($propertyName);

            if (method_exists($bindingModel, $setterMethod)) {
                try {
                    $bindingModel->$setterMethod($value);
                } catch (FormValidationException $e) {
                    $this->session->addMessage('error', $e->getMessage());
                    header("Location: " . $this->request->getReferrer());
                    exit;
                }
            } else {
                $property->setAccessible(true);
                $property->setValue($bindingModel, $value);
            }
        }
    }

    private function tryInstantiateDependency($className)
    {
        if (array_key_exists($className, $this->resolvedDependencies)) {
            return $this->resolvedDependencies[$className];
        }

        $implementation = $this->dependencies[$className];

        return $this->resolve($implementation);
    }
}