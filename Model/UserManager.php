<?php

// require_once 'src/Model/User.php';
require_once './Model/AbstractManager.php';

class UserManager extends AbstractManager
{
    public function findById(int $id): ?Users
    {
        $query = $this->database->prepare('SELECT * FROM users WHERE id = :id');
        $query->execute([
            'id' => $id
        ]);

        $rawData = $query->fetch(PDO::FETCH_ASSOC);

        if ($rawData === false) {
            return null;
        } else {
            $User = new Users();

            $User->setId($rawData['id']);
            $User->setFirstName($rawData['firstName']);
            $User->setLastName($rawData['lastName']);
            $User->setEmail($rawData['email']);
            $User->setPassword($rawData['password']);
            $User->setUserStatus($rawData['status']);
        }
        return $User;
    }


    public function findByEmail(string $email): ?Users
    {
        $query = $this->database->prepare('SELECT * FROM users WHERE email = :email');
        $query->execute([
            'email' => $email
        ]);

        $rawData = $query->fetch(PDO::FETCH_ASSOC);

        if ($rawData === false) {
            return null;
        } else {
            $User = new Users();

            $User->setId($rawData['id']);
            $User->setFirstName($rawData['firstName']);
            $User->setLastName($rawData['lastName']);
            $User->setEmail($rawData['email']);
            $User->setPassword($rawData['password']);
            $User->setUserStatus($rawData['status']);
        }
        return $User;
    }

    public function insert(Users $User): Users
    {
        $query = $this->database->prepare('
            INSERT INTO users(firstName, lastName, email, password, status)
            VALUES (:firstName, :lastName, :email, :password, :status)
        ');
        // var_dump($User->getCreatedAt());
        // date_default_timezone_set('Europe/Paris');


        // $date= new DateTime();


        $query->execute([
            'firstName' => $User->getFirstName(),
            'lastName' => $User->getLastName(),
            'email' => $User->getEmail(),
            // 'createdAt'=> $User->getCreatedAt(),
            'password' => $User->getPassword(),
            'status' =>  $User->getUserStatus()
        ]);
        return $User;
    }

    public function emailVerify(string $email): Bool
    {
        $query = $this->database->prepare('SELECT email FROM users WHERE email = :email');
        $query->execute([
            'email' => $email
        ]);

        $rawData = $query->fetch(PDO::FETCH_ASSOC);

        if (isset($rawData['email'])) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
}
