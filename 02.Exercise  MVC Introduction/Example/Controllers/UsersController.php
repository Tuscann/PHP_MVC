<?php
namespace SoftUni\Controllers;

use SoftUni\Core\View;
use SoftUni\Core\ViewInterface;
use SoftUni\Models\Binding\Users\UserLoginBindingModel;
use SoftUni\Models\Binding\Users\UserRegisterBindingModel;
use SoftUni\Models\View\ApplicationViewModel;
use SoftUni\Services\UserService;
use SoftUni\Services\UserServiceInterface;

class UsersController
{
    public function login(ViewInterface $view)
    {
        $view->render();
    }

    public function loginPost(
        UserLoginBindingModel $bindingModel,
        UserServiceInterface $service)
    {
        $username = $bindingModel->getUsername();
        $password = $bindingModel->getPassword();

        if ($service->login($username, $password)) {
            header("Location: /mvc/users/profile");
            exit;
        }

        throw new \Exception();
    }

    public function register(ViewInterface $view)
    {
        $viewModel = new ApplicationViewModel("Forum");
        $view->render($viewModel);
    }

    public function registerPost(UserRegisterBindingModel $bindingModel, UserServiceInterface $service)
    {
        $username = $bindingModel->getUsername();
        $password = $bindingModel->getPassword();

        if ($service->register($username, $password)) {
            header("Location: /mvc/users/login");
            exit;
        }

        throw new \Exception();
    }

    public function profile()
    {
        echo $_SESSION['id'] . "<br/>";
        echo "PRofile";
    }
}