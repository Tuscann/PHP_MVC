<?php
namespace SoftUni\Adapter;

interface DatabaseStatementInterface
{
    public function execute(array $args = []): bool;

    public function fetch();

    public function fetchAll();

    public function fetchObject(string $class);

    public function rowCount();
}