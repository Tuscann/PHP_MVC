<?php
namespace Controllers;


use Core\Http\Components\Session\SessionInterface;
use Core\View;
use Core\ViewInterface;
use Models\LoginViewModel;
use Models\RegisterViewModel;
use Models\UserRegisterBindingModel;

class UsersController
{

    public function test(ViewInterface $view)
    {
        $view->render();
    }

    public function register(ViewInterface $view)
    {
        $viewModel = new RegisterViewModel("Register page");
        $view->render($viewModel);
    }

    public function registerProcess($name,
                                    UserRegisterBindingModel $bindingModel,
                                    ViewInterface $view,
                                    $id)
    {
        if ($bindingModel->getConfirmPassword() != $bindingModel->getPassword()) {
            throw new \Exception("Password mismatch");
        }

        echo "ок $name - $id - {$bindingModel->getPassword()} - " . get_class($view); /// debug purposes
        // insert to db
    }

    public function login($id)
    {
        $view = new View();
        $view->render('users/login', new LoginViewModel(380, 44));
    }


}