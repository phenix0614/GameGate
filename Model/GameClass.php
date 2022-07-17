<?php

class Games {
    private string $id;
    private string $gameName;
    private DateTime $createdAt;
    private string $link;
    private string $content;
    private string $category;


    

public function setId($id): void {
    $this->id = $id;
}
public function getId(): int {
    return $this->id;
}


public function setGameName($gameName): void 
{
    $this->gameName=$gameName;
}
public function getGameName(): String
{
    return $this->gameName;
}



public function setCreatedAt( $createdAt):Void
{
    $this->createdAt=$createdAt;
}
public function getCreatedAt(): DateTime
{
    return $this->createdAt;
}


public function setLink($link): void 
{
    $this->link=$link;
}
public function getLink():string 
{
    return $this->link;
}


public function setContent($content): void 
{
    $this->content=$content;
}
public function getContent():string 
{
    return $this->content;
}
public function setCategory($category): void 
{
    $this->category=$category;
}
public function getCategory():string 
{
    return $this->category;
}


}