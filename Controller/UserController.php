<?php

require_once './Model/UserClass.php';
require_once './Model/UserManager.php';
require_once './tools/Authentificator.php';

class UserController

{


    public function register(): void
    {

        $Manager = new UserManager();

        if (
            isset($_POST['firstName']) && isset($_POST['lastName']) && isset($_POST['email'])
            && isset($_POST['password1']) && isset($_POST['password2'])
        ) {
            if ($Manager->emailVerify($_POST['email']) === TRUE) {
                echo "<script>alert(\"Le mail existe deja, veuillez en choisir un autre\")</script>";
                header("Refresh: 1");
                exit();
            }

            if ($_POST['password1'] === $_POST['password2'] && $Manager->emailVerify($_POST['email']) === false) {

                $User = new Users();
                $User->setFirstName($_POST['firstName']);
                $User->setLastName($_POST['lastName']);
                $User->setEmail($_POST['email']);
                $User->setUserStatus($_POST['status']);
                $User->setCtrPassword($_POST['password1']);
                $User->setPassword(
                    password_hash($_POST['password1'], PASSWORD_ARGON2ID)
                );

                $mailerror = $User->validEmail($User->getEmail());
                if ($mailerror === false) {
                    echo "<script>alert(\"Format email invalide.\")</script>";
                }

                $passwordError = $User->validPassword($User->getCtrPassword());
                if ($passwordError === false) {
                    echo "<script>alert(\"Le mot de passe ne peut pas avoir une taille inférieure à 8 caractères.\")</script>";
                }


                if ($mailerror === TRUE && $passwordError === TRUE) {
                    $User->erasePassword();
                    $Manager->insert($User);
                    echo "<script>alert(\"Votre profile a bien été creer\")</script>";
                    header("Refresh: 1; index.php");
                    exit;
                }
            }
        }

        $template = './template/registerPage.phtml';
        require './view/layout.phtml';
    }



    public function login(): void
    {
        if (isset($_POST['email']) && isset($_POST['password'])) {
            $Manager = new UserManager();
            $user = $Manager->findByEmail($_POST['email']);

            if (password_verify($_POST['password'], $user->getPassword()) === true) {
                $authentifier = new Authentificator();
                $authentifier->login($user->getId(), $user->getLastName(), $user->getUserStatus());

                echo 'bonjour' . ' ' . $user->getLastName();
                header('Refresh: 2 ; index.php');
                exit;
            } else {
                echo "<script>alert(\"Email ou mot de passe invalide\")</script>";
            }
        }

        $template = './template/loginPage.phtml';

        require './view/layout.phtml';
    }



    public function logout(): void
    {
        $authentifier = new Authentificator();
        $authentifier->logout();
        header('Location: index.php');
        exit;
    }



    public function viewUserPage(): void
    {
        $Manager = new UserManager();
        $User = $Manager->findById($_SESSION['user_id']);
        $template = './template/userPage.phtml';
        require './view/layout.phtml';
    }



    public function viewAdminPage(): void
    {
        $list = new UserManager();
        $UserList = $list->findAll();
        $template = './template/adminPage.phtml';
        require './view/layout.phtml';
        var_dump($_POST);
        if (isset($_POST['delete'])) {

            $list->delete(intval($_POST['delete']));
            echo "<script>alert(\"Utilisateur supprimé\")</script>";
            header('Location: /index.php?page=adminPage&id=' . $_GET['id']);
        }
    }



    public function viewUpDatePage(): void
    {
        $manager = new UserManager();
        $User = $manager->findById($_SESSION['user_id']);

        $template = './template/personalUpDate.phtml';
        require './view/layout.phtml';

        if (isset($_POST['modify'])) {
            $Modify_user = new Users;
            $Modify_user->setId($_SESSION['user_id']);
            $Modify_user->setFirstName($_POST['firstName']);
            $Modify_user->setLastName($_POST['lastName']);
            $Modify_user->setEmail($_POST['email']);


            $manager->upDateUser($Modify_user);
            echo "<script>alert(\"Vos données ont été modifier\")</script>";
            header('Location: /index.php?page=userPage&id=' . $_GET['id']);
        }
    }
}
