<?php
require './Model/GameManager.php';
require './Model/CommentManager.php';

class GameController

{

    public function viewGameList(): void
    {

        $manager = new GameManager();
        $Games = $manager->findAll();
        $template = 'template/gameListPage.phtml';
        require 'view/layout.phtml';
    }



    public function viewGameAdd(): void
    {

        if (isset($_POST['gameName']) && isset($_POST['link']) && isset($_POST['content']) && isset($_POST['category'])) {
            date_default_timezone_set('Europe/Paris');

            $date = new datetime();

            $Game = new Games();
            $Game->setGameName($_POST['gameName']);
            $Game->setLink($_POST['link']);
            $Game->setCreatedAt($date);
            $Game->setContent($_POST['content']);
            $Game->setCategory($_POST['category']);

            $GameManager = new GameManager();
            $GameManager->insert($Game);
            $success = 'Votre jeu  a bien été ajouter';
            echo $success;
            header("Refresh: 3; index.php");
            exit;
        }

        $template = 'template/gameAddPage.phtml';
        require 'view/layout.phtml';
    }


    public function viewGamePage(): void
    {

        $manager = new GameManager();
        $comentManager = new CommentManager();

        $Game = $manager->findById($_GET['id']);

        if (isset($_POST['comment'])) {
            $CommentRegister = new Comment();
            $CommentRegister->setComment($_POST['comment']);
            $CommentRegister->setidGameCom($_GET['id']);
            $CommentRegister->setidUserCom($_SESSION['user_id']);

            $comentManager->publish($CommentRegister);
            header('Location: /index.php?page=gamePage&id=' . $_GET['id']);
        }
        $rawData = $comentManager->findByGame($_GET['id']);


        $template = './template/gamePage.phtml';
        require 'view/layout.phtml';
    }
}
