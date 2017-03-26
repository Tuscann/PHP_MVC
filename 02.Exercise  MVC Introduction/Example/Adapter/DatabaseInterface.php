<?php
namespace SoftUni\Adapter;

interface DatabaseInterface
{
    public function prepare($statement): DatabaseStatementInterface;
}