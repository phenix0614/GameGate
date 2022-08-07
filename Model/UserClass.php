<?php

class Users
{

    private INT $id;
    private string $firstName;
    private string $lastName;
    private string $email;
    private string $password;
    private ?string $ctrPassword;
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


    public function setUserStatus($userStatus): void
    {
        $this->userStatus = $userStatus;
    }
    public function getUserStatus(): string
    {
        return $this->userStatus;
    }

    public function validEmail(STRING $email): bool
    {
        return (!preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $email)) ? FALSE : TRUE;
    }


    public function validPassword(STRING $ctrPassword): BOOL
    {
        return (strlen($ctrPassword) > 6) ? TRUE : FALSE;
    }

    public function erasePassword(): void
    {
        $this->ctrPassword = null;
    }
}
