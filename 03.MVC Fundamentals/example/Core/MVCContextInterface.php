<?php


namespace Core;


interface MVCContextInterface
{
    public function getControllerName();

    public function getControllerFullName();

    public function getAction();

    public function getURI();

    public function getArgs();

    public function getFullUri();
}