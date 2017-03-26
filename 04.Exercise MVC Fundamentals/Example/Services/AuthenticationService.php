<?php
namespace SoftUni\Services;

use SoftUni\Core\MVC\SessionInterface;

class AuthenticationService implements AuthenticationServiceInterface
{
    private $session;

    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
    }

    public function isAuthenticated(): bool
    {
        return $this->session->exists('id');
    }

    public function logout()
    {
        $this->session->destroy();
    }

    public function getUserId()
    {
        return $this->session->get('id');
    }
}