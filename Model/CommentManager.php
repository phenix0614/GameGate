<?php

require 'Model/CommentClass.php';

class CommentManager extends AbstractManager
{

    public function publish(Comment $comment)
    {
        $query = $this->database->prepare('
            INSERT INTO gameComent (game_id, user_id, comment)
            VALUES (:game_id, :user_id,:comment)
        ');

        $query->execute([
            'game_id' => $comment->getidGameCom(),
            'user_id' => $comment->getidUserCom(),
            'comment' => $comment->getComment(),

        ]);

        return $comment;
    }


    public function findByGame($id): array
    {
        $query = $this->database->prepare('SELECT comment, lastName,gameName FROM gameComent 
        INNER JOIN users ON gameComent.user_id = users.id INNER JOIN games ON gameComent.game_id = games.id WHERE game_id = :game_id');
        $query->execute([
            'game_id'=> $id
        ]);

        $rawData = $query->fetchAll(PDO::FETCH_ASSOC);

        if ($rawData === false) {
            return [];
        }
        return $rawData;
    }
}
