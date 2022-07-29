<?php

require 'Model/CommentClass.php';
// require 'Model/AbstractManager.php';

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
            // 'createdAt'=> $comment->getCreatedAt(new datetime()),

        ]);

        return $comment;
    }


    public function findAll(): array
    {
        $query = $this->database->prepare('SELECT * FROM gameComent');
        $query->execute();

        $rawData = $query->fetchAll(PDO::FETCH_ASSOC);

        if ($rawData === false) {
            return [];
        }

        $tabComment = [];

        foreach ($rawData as $rawComment) {
            $CommentList = new COmment();

            $CommentList->setId($rawComment['id']);
            // $CommentList->setGameName($rawComment['']);
            // $CommentList->setidUserCom($rawComment['id']);
            $CommentList->setComment($rawComment['comment']);
            $CommentList->setCreatedAt(
                new DateTime($rawComment['createdAt'])
            );

            $tabComment[] = $CommentList;
        }
        return $tabComment;
    }
}
