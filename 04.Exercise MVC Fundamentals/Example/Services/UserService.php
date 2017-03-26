<?php
namespace SoftUni\Services;

use SoftUni\Adapter\Database;
use SoftUni\Adapter\DatabaseInterface;
use SoftUni\Core\MVC\SessionInterface;
use SoftUni\Models\Binding\Users\UserProfileEditBindingModel;
use SoftUni\Models\DB\User;

class UserService implements UserServiceInterface
{
    /**
     * @var Database
     */
    private $db;

    /**
     * @var SessionInterface
     */
    private $session;

    /**
     * @var EncryptionServiceInterface
     */
    private $encryptionService;

    public function __construct(DatabaseInterface $db,
                                SessionInterface $session,
                                EncryptionServiceInterface $encryptionService)
    {
        $this->db = $db;
        $this->session = $session;
        $this->encryptionService = $encryptionService;
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

        $hash = $user->getPassword(); // $2y$10$FwfcoPrVpk/oku5BoY1HD.AATr/fmBu2/2b6KqGqisAweI/URW5L.

        if ($this->encryptionService->verify($password, $hash)) { // 333, $2y$10$FwfcoPrVpk/oku5BoY1HD.AATr/fmBu2/2b6KqGqisAweI/URW5L.
            $this->session->set('id', $user->getId());
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
                $this->encryptionService->hash($password)
            ]
        );
    }

    public function findOne($id): User
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
            id = ?
          LIMIT 1";


        $stmt = $this->db->prepare($query);
        $stmt->execute(
            [
                $id
            ]
        );

        /** @var User $user */
        $user = $stmt->fetchObject(User::class);

        return $user;
    }

    public function edit(UserProfileEditBindingModel $model): bool
    {
        if ($model->getPassword() != $model->getConfirmPassword()){
            return false;
        }

        $query = "
           UPDATE users
           SET username = ?, password = ?, email = ?, birthday = ?
           WHERE id = ?
        ";

        $stmt = $this->db->prepare($query);
        return $stmt->execute(
            [
                $model->getUsername(),
                $this->encryptionService->hash($model->getPassword()),
                $model->getEmail(),
                $model->getBirthday(),
                $model->getId()
            ]
        );

    }
}