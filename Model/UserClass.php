<?php

class Users
{

    private INT $id;
    private string $firstName;
    private string $lastName;
    private string $email;
    private string $password;
    private ?string $ctrPassword;
    // private DateTime $createdAt;
    private string $userStatus;

    public function setId(INT $id): VOID
    {
        $this->id = $id;
    }
    public function getId(): INT
    {
        return $this->id;
    }


    public function setFirstName($firstName): void
    {
        $this->firstName = $firstName;
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }



    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }
    public function getLastName(): string
    {
        return $this->lastName;
    }


    public function setEmail($email): void
    {
        $this->email = $email;
    }
    public function getEmail(): string
    {
        return $this->email;
    }


    public function setPassword($password): void
    {
        $this->password = $password;
    }
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setCtrPassword($ctrPassword): void
    {
        $this->ctrPassword = $ctrPassword;
    }
    public function getCtrPassword(): string
    {
        return $this->ctrPassword;
    }



    // public function  setCreatedAt(dateTime $createdAt): void
    // {
    //     $this->createdAt = $createdAt;
    // }
    // public function getCreatedAt(): DateTime
    // {
    //     return $this->createdAt;
    // }

    public function setUserStatus($userStatus): void
    {
        $this->userStatus = $userStatus;
    }
    public function getUserStatus(): string
    {
        return $this->userStatus;
    }

    public function validPasswordEmail(): array
    {
        $errors = [];

        if (strlen($this->ctrPassword) < 6) {
            $errors['password'] = 'Le mot de passe ne peut pas avoir une taille inférieure à 6 caractères.';
        }

        if (preg_match('/.+@.+\..+/', $this->email) === 0) {
            $errors['email'] = 'Format d\'email invalide.';
        }

        return $errors;
    }

    public function erasePassword(): void
    {
        $this->ctrPassword = null;
    }
}
