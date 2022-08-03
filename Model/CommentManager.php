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
            // $CommentList->setCreatedAt(
            //     new DateTime($rawComment['createdAt'])
            // );

            $tabComment[] = $CommentList;
        }
        return $tabComment;
    }


    public function findAllById(int $id): ?Comment
    {
        $query = $this->database->prepare('SELECT * FROM gameComent WHERE game_id = :game_id');
        $query->execute([
            'game_id' => $id
        ]);

        $rawData = $query->fetch(PDO::FETCH_ASSOC);

        if ($rawData === false) {
            return null;
        }

        var_dump($rawData);

        $Comment = new Comment();
    
        $Comment->setId($rawData['id']);
        $Comment->setcomment($rawData['comment']);
        // $Comment->setcreatedAt($rawData['createdAt']);
        $Comment->setidGameCom($rawData['game_id']);
        $Comment->setidUserCom($rawData['user_id']);

        $query = $this->database->prepare('SELECT gameName FROM games WHERE id = :id');
        $query->execute([
            'id' => $Comment->getidGameCom()

        ]);

        $rawGamecom = $query->fetch(PDO::FETCH_ASSOC);

        $Comment-> setGameName($rawGamecom['gameName']);


        $query = $this->database->prepare('SELECT lastName FROM users WHERE id = :id');
        $query->execute([
            'id' => $Comment->getidUserCom()

        ]);

        $rawUsercom = $query->fetch(PDO::FETCH_ASSOC);

        $Comment-> setUserName($rawUsercom['lastName']);

        return $Comment;
    }



    // public function findUserNameById(int $id): ?STRING
    // {

    //     $query = $this->database->prepare('SELECT "user_id" FROM gameComent WHERE id = :id');
    //     $query->execute([
    //         'id' => $id
    //     ]);

    //     $rawData = $query->fetch(PDO::FETCH_ASSOC);

    //     if ($rawData === false) {
    //         return null;
    //     }

    //     $Comment = new Comment();
    
    //     $Comment->setId($id);
    //     $Comment->setidUserCom($rawData['user_id']);


    //     $query = $this->database->prepare('SELECT lastName FROM users WHERE id = :id');
    //     $query->execute([
    //         'id' => $Comment->getidUserCom()
    //     ]);
        
    //     return $Comment;
    // }


}
