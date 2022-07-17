<?php

require_once './Model/UserClass.php';
require_once './Model/UserManager.php';
require_once './tools/Authentificator.php';

class UserController

{
    public function register(): void
    {
        $errors = [];

        $success = 'Votre profile a bien été creer';
        $Manager = new UserManager();

        if (
            isset($_POST['firstName']) && isset($_POST['lastName']) && isset($_POST['email'])
            && isset($_POST['password1']) && isset($_POST['password2'])
        ) {
            if ($Manager->emailVerify($_POST['email']) === TRUE) {
                echo "<script>alert(\"Le mail existe deja, veuillez en choisir un autre\")</script>";
                // echo 'Le mail existe deja, veuillez en choisir un autre';
                header("Refresh: 1");
                exit();
            }

            if ($_POST['password1'] === $_POST['password2'] && $Manager->emailVerify($_POST['email']) === false) {

                // date_default_timezone_set('Europe/Paris');

                // $date= new datetime() ;

                $User = new Users();
                $User->setFirstName($_POST['firstName']);
                $User->setLastName($_POST['lastName']);
                $User->setEmail($_POST['email']);
                // $User->setCreatedAt( $date);
                $User->setUserStatus($_POST['status']);
                $User->setCtrPassword($_POST['password1']);
                $User->setPassword(
                    password_hash($_POST['password1'], PASSWORD_ARGON2ID)
                );

                $errors = $User->validPasswordEmail();
                $User->erasePassword();
                if (empty($errors)) {
                    // $Manager = new UserManager();
                    $Manager->insert($User);
                    echo $success;
                    header("Refresh: 3; index.php");
                    exit;
                } else {
                    echo $errors;
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

                echo 'bonjour'.' '.$user->getLastName();
                header('Refresh: 3 ; index.php');
                exit;
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
        $Manager= new UserManager();
        $User= $Manager->findById($_SESSION['user_id']);


        $template = './template/userPage.phtml';

        require './view/layout.phtml';
    }
}
