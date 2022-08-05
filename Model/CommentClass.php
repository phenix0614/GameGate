<?php

class Comment
{
    private INT $id;
    private string $comment;
    private DateTime $createdAt;
    private INT $idGameCom;
    private INT $idUserCom;
    private STRING $gameName;
    private STRING $userName;



    public function setId(INT $id): void
    {
        $this->id = $id;
    }
    public function getId(): INT
    {
        return $this->id;
    }


    public function setComment(string $comment): void
    {
        $this->comment = $comment;
    }
    public function getComment(): string
    {
        return $this->comment;
    }


    public function setCreatedAt(DATETIME $createdAt): Void
    {
        $this->createdAt = $createdAt;
    }
    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }


    public function setidGameCom(INT $idGameCom): void
    {
        $this->idGameCom = $idGameCom;
    }
    public function getidGameCom(): INT
    {
        return $this->idGameCom;
    }


    public function setidUserCom(INT $idUserCom): void
    {
        $this->idUserCom = $idUserCom;
    }
    public function getidUserCom(): INT
    {
        return $this->idUserCom;
    }

    public function setGameName(STRINg $gameName): void
    {
        $this->gameName = $gameName;
    }
    public function getGameName(): STRING
    {
        return $this->gameName;
    }

    public function setUserName(STRING $userName): void
    {
        $this->userName = $userName;
    }
    public function getUserName(): STRING
    {
        return $this->userName;
    }
}
