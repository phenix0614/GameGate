<?php

require 'Model/GameClass.php';
require 'Model/AbstractManager.php';

class GameManager extends AbstractManager
{
    public function findById(int $id): ?Games
    {
        $query = $this->database->prepare('SELECT * FROM games WHERE id = :id');
        $query->execute([
            'id' => $id
        ]);

        $rawData = $query->fetch(PDO::FETCH_ASSOC);

        if ($rawData === false) {
            return null;
        }

        $Game = new Games();
        $Game->setId($rawData['id']);
        $Game->setGameName($rawData['gameName']);
        $Game->setContent($rawData['content']);
        $Game->setLink($rawData['link']);
        $Game->setCategory($rawData['category']);
        return $Game;
    }



    public function findAll(): array
    {
        $query = $this->database->prepare('SELECT * FROM games');
        $query->execute();

        $rawData = $query->fetchAll(PDO::FETCH_ASSOC);

        if ($rawData === false) {
            return [];
        }

        $games = [];

        foreach ($rawData as $rawGame) {
            $Game = new Games();

            $Game->setId($rawGame['id']);
            $Game->setGameName($rawGame['gameName']);
            $Game->setContent($rawGame['content']);
            $Game->setLink($rawGame['link']);
            $Game->setCategory($rawGame['category']);
            $Game->setCreatedAt(
                new DateTime($rawGame['createdAt'])
            );

            $games[] = $Game;
        }

        return $games;
    }

    public function insert(Games $Game): Games
    {
        $query = $this->database->prepare('
            INSERT INTO games (gameName, link, content, category)
            VALUES (:gameName, :link, :content , :category)
        ');

        $query->execute([
            'gameName' => $Game->getGameName(),
            'link' => $Game->getLink(),
            'content' => $Game->getContent(),
            'category' => $Game->getCategory()
        ]);

        return $Game;
    }

    public  function delete(Games $Game): void
    {
        $query = $this->Bdd->prepare('DELETE FROM games WHERE id = :id');
        $query->execute([
            'id' => $Game->getId()
        ]);
    }

    public function update(Games $Game): void
    {
        $query = $this->Bdd->prepare('UPDATE games SET gameName= :gameName, link= :link, content= :content , category :category WHERE id = :id');

        $query->execute([
            'gameName' => $Game->getGameName(),
            'link' => $Game->getLink(),
            'content' => $Game->getContent(),
            'category' => $Game->getCategory()
        ]);
    }
}
