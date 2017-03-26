<?php


namespace Models;


use Core\Exceptions\FormValidationException;

class UserRegisterBindingModel
{
    private $username;
    private $password;
    private $confirmPassword;

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @return mixed
     */
    public function getConfirmPassword()
    {
        return $this->confirmPassword;
    }

    /**
     * @param mixed $username
     * @throws FormValidationException
     */
    public function setUsername($username)
    {
        if (strlen($username) < 3) {
            throw new FormValidationException("username too short");
        }

        $this->username = $username;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @param mixed $confirmPassword
     */
    public function setConfirmPassword($confirmPassword)
    {
        $this->confirmPassword = $confirmPassword;
    }




}