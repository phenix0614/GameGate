<?php


class Authentificator
{
    public function startSession(): void
    {
        session_start();
    }

    public function login(int $userId, STRING $userName, STRING $userStatus): void
    {
        $_SESSION['user_id'] = $userId;
        $_SESSION['user_Name'] = $userName;
        $_SESSION['user_status'] = $userStatus;
    }

    public function logout(): void
    {
        unset($_SESSION['user_id']);
        session_destroy();
        header("Refresh: 1; index.php");
    }
}
