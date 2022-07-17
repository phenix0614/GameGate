<?php

class Router
{
    private array $authorizedPages = [
        'homePage', 'userPage',
        'login', 'gameList',
        'register', 'logout',
        'gameAdd', 'gamePage'
    ];

    public function Way(): void
    {
        $page = 'homePage';

        if (isset($_GET['page']) && in_array($_GET['page'], $this->authorizedPages)) {
            $page = $_GET['page'];
        }

        switch ($page) {

            case 'homePage':
                require 'Controller/HomeController.php';
                $controller = new HomeController();
                $controller->viewHome();
                break;

            case 'login':
                require './Controller/UserController.php';
                $controller = new UserController();
                $controller->login();
                break;

            case 'logout':
                require_once './tools/Authentificator.php';
                $Authentificator = new Authentificator();
                $Authentificator->logout();
                break;


            case 'register':
                require './Controller/UserController.php';
                $controller = new UserController();
                $controller->register();
                break;

            case 'gameList':
                require 'Controller/GameController.php';
                $controller = new GameController();
                $controller->viewGameList();
                break;

            case 'gameAdd':
                require 'Controller/GameController.php';
                $controller = new GameController();
                $controller->viewGameAdd();
                break;

            case 'gamePage':
                require 'Controller/GameController.php';
                $controller = new GameController();
                $controller->viewGamePage();
                break;

            case 'userPage':
                require './Controller/UserController.php';
                $controller = new UserController();
                $controller->viewUserPage();
                break;
        }
    }
}
