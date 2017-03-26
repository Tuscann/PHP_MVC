<?php
namespace SoftUni\Services;

use SoftUni\Adapter\Database;
use SoftUni\Adapter\DatabaseInterface;
use SoftUni\Models\DB\User;

class UserService implements UserServiceInterface
{
    /**
     * @var Database
     */
    private $db;

    public function __construct(DatabaseInterface $db)
    {
        $this->db = $db;
    }

    public function login($username, $password): bool
    {
        $query = "
          SELECT 
              id, 
              username, 
              password, 
              first_name AS firstName, 
              last_name AS lastName, 
              role, 
              email, 
              birthday 
          FROM 
            users 
          WHERE 
            username = ?
          LIMIT 1";


        $stmt = $this->db->prepare($query);
        $stmt->execute(
            [
                $username
            ]
        );

        /** @var User $user */
        $user = $stmt->fetchObject(User::class);

        if ($user == null) {
            return false;
        }

        $hash = $user->getPassword();

        if (password_verify($password, $hash)) {
            $_SESSION['id'] = $user->getId();
            return true;
        }

        return false;
    }

    public function register($username, $password): bool
    {
        $query = "INSERT INTO users (username, password) VALUES (?, ?)";
        $stmt = $this->db->prepare($query);
        return $stmt->execute(
            [
                $username,
                password_hash($password, PASSWORD_BCRYPT)
            ]
        );
    }
}