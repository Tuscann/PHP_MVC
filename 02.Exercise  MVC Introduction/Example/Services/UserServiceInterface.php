<?php
namespace SoftUni\Services;

interface UserServiceInterface
{
    public function login($username, $password): bool;

    public function register($username, $password): bool;
}