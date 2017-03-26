<?php
require_once '../Services/UserServiceInterface.php';
require_once '../Controllers/UsersController.php';
require_once '../Models/Binding/Users/UserLoginBindingModel.php';

class UserServiceFake implements \SoftUni\Services\UserServiceInterface
{
    public function login($username, $password): bool
    {
        return false;
    }

    public function register($username, $password): bool
    {
        return false;
    }
}

$controller = new \SoftUni\Controllers\UsersController();
try {
        $controller->loginPost(
            new \SoftUni\Models\Binding\Users\UserLoginBindingModel(),
            new UserServiceFake()
        );
} catch (Exception $e) {
    echo "Test passed. Failed to login with wrong username and password";
}
