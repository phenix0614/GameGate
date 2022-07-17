<?php

// require_once 'src/Model/UserManager.php';

class Authentificator
{
    public function startSession(): void
    {
        session_start();
    }
    
    public function login(int $userId, $userName,$userStatus): void
    {
        $_SESSION['user_id'] = $userId;
        $_SESSION['user_Name']= $userName;
        $_SESSION['user_status']= $userStatus;
    }
    
    public function logout(): void
    {
        unset($_SESSION['user_id']);
        session_destroy();
        header("Refresh: 1; index.php");

    }
    
    // public function getUser(): ?User
    // {
    //     if (!isset($_SESSION['user_id'])) {
    //         return null;
    //     }

    //     $manager = new UserManager();
    //     return $manager->findById($_SESSION['user_id']);
    // }
}
