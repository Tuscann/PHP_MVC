<?php
namespace SoftUni\Adapter;

class DatabaseStatement implements DatabaseStatementInterface
{
    private $stmt;

    public function __construct(\PDOStatement $stmt)
    {
        $this->stmt = $stmt;
    }

    public function execute(array $args = []): bool
    {
        return $this->stmt->execute($args);
    }

    public function fetch()
    {
        return $this->stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public function fetchAll()
    {
        return $this->stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function fetchObject(string $class)
    {
        return $this->stmt->fetchObject($class);
    }

    public function rowCount()
    {
        return $this->stmt->rowCount();
    }
}