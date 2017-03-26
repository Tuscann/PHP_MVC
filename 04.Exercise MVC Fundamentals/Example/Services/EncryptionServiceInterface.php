<?php
namespace SoftUni\Services;

interface EncryptionServiceInterface
{
    public function hash(string $password): string;

    public function verify(string $password, string $hash): bool;
}