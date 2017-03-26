<?php
namespace SoftUni\Core\MVC;


interface MVCContextInterface
{
    public function getController(): string;

    public function getAction(): string;

    public function getURIJunk(): string;

    public function getArguments(): array;
}