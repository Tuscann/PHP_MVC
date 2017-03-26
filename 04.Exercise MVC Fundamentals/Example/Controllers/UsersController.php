<?php
namespace SoftUni\Controllers;

use SoftUni\Core\MVC\SessionInterface;
use SoftUni\Core\ViewInterface;
use SoftUni\Models\Binding\Users\UserLoginBindingModel;
use SoftUni\Models\Binding\Users\UserProfileEditBindingModel;
use SoftUni\Models\Binding\Users\UserRegisterBindingModel;
use SoftUni\Models\View\ApplicationViewModel;
use SoftUni\Models\View\UserProfileEditViewModel;
use SoftUni\Models\View\UserProfileViewModel;
use SoftUni\Services\AuthenticationServiceInterface;
use SoftUni\Services\ResponseServiceInterface;
use SoftUni\Services\UserService;
use SoftUni\Services\UserServiceInterface;

class UsersController
{
    private $view;
    private $userService;
    private $responseService;
    private $authenticationService;

    public function __construct(
        ViewInterface $view,
        UserServiceInterface $userService,
        ResponseServiceInterface $responseService,
        AuthenticationServiceInterface $authenticationService)
    {
        $this->view = $view;
        $this->userService = $userService;
        $this->responseService = $responseService;
        $this->authenticationService = $authenticationService;
    }

    public function login()
    {
        $this->view->render();
    }

    public function loginPost(
        UserLoginBindingModel $bindingModel // $_POST['username'], $_POST['password']
        ) // UserService($db)
    {
        $username = $bindingModel->getUsername(); // Stamat
        $password = $bindingModel->getPassword(); // 333

        if ($this->userService->login($username, $password)) {
            $this->responseService->redirect("users", "profile");
        }

        throw new \Exception();
    }

    public function register(ViewInterface $view)
    {
        $viewModel = new ApplicationViewModel("Forum");
        $view->render($viewModel);
    }

    public function registerPost(UserRegisterBindingModel $bindingModel)
    {
        $username = $bindingModel->getUsername();
        $password = $bindingModel->getPassword();

        if ($this->userService->register($username, $password)) {
            $this->responseService->redirect("users", "login");
        }

        throw new \Exception();
    }

    public function profile()
    {
        if(!$this->authenticationService->isAuthenticated()) {
            $this->responseService->redirect("users", "login");
        }

        $id = $this->authenticationService->getUserId();

        $user = $this->userService->findOne($id);

        $viewModel = new UserProfileViewModel();
        $viewModel->setUsername($user->getUsername());
        $viewModel->setId($id);

        $this->view->render($viewModel);
    }

    public function profileEdit($id)
    {
        $currentUserId = $this->authenticationService->getUserId();
        if ($currentUserId !== $id) {
            $this->responseService->redirect("users", "profileEdit", [$currentUserId]);
        }

        $user = $this->userService->findOne($id);

        $viewModel = new UserProfileEditViewModel(
            $id,
            $user->getUsername(),
            $user->getPassword(),
            $user->getEmail(),
            $user->getBirthday(),
            false
        );

        return $this->view->render($viewModel);
    }

    public function profileEditPost($id,
                                    UserProfileEditBindingModel $bindingModel)
    {
        $currentUserId = $this->authenticationService->getUserId();
        if ($currentUserId !== $id) {
            $this->responseService->redirect("users", "profileEdit", [$currentUserId]);
        }

        $bindingModel->setId($id);

        $this->userService->edit($bindingModel);

        $this->responseService->redirect("users", "profile", [$id]);
    }
}