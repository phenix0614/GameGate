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


    public function findByGame($id): array
    {
        $query = $this->database->prepare('SELECT comment, lastName,gameName FROM gameComent INNER JOIN users ON gameComent.user_id = users.id INNER JOIN games ON gameComent.game_id = games.id WHERE game_id = :game_id');
        $query->execute([
            'game_id'=> $id
        ]);

        $rawData = $query->fetchAll(PDO::FETCH_ASSOC);

        if ($rawData === false) {
            return [];
        }



        // $tabComment = [];
        

        // foreach ($rawData as $rawCommen) {
        //     $CommentList = new Comment();

        //     $CommentList->setId($rawComment['id']);
        //     $CommentList->setidGameCom($rawComment['game_id']);
        //     $CommentList->setidUserCom($rawComment['user_id']);
        //     $CommentList->setComment($rawComment['comment']);


        //     // $CommentList->setCreatedAt(
        //     //     new DateTime($rawComment['createdAt'])
        //     // );

        //     $tabComment[] = $CommentList;
            // var_dump($tabComment);
        // }
        return $rawData;
    }

    // public function findAll(): array
    // {
    //     $query = $this->database->prepare('SELECT * FROM gameComent');
    //     $query->execute();

    //     $rawData = $query->fetchAll(PDO::FETCH_ASSOC);

    //     if ($rawData === false) {
    //         return [];
    //     }

    //     $tabComment = [];

    //     foreach ($rawData as $rawComment) {
    //         $CommentList = new COmment();

    //         $CommentList->setId($rawComment['id']);
    //         // $CommentList->setGameName($rawComment['']);
    //         // $CommentList->setidUserCom($rawComment['id']);
    //         $CommentList->setComment($rawComment['comment']);
    //         // $CommentList->setCreatedAt(
    //         //     new DateTime($rawComment['createdAt'])
    //         // );

    //         $tabComment[] = $CommentList;
    //     }
    //     return $tabComment;
    // }



//     public function findAllById(int $id): Array
//     {
//         $tabComment=[];

//         $queryGameId = $this->database->prepare('SELECT comment FROM gameComent  WHERE game_id = :game_id');
//         $queryGameId->execute([
//             'game_id' => $id
//         ]);

//         $rawData = $queryGameId->fetch(PDO::FETCH_ASSOC);

//         if ($rawData === false) {
//             return null;
//         }

//         var_dump($rawData);
//         foreach ($rawData  as $rawComment) {
//             $Comment = new Comment();
    
//             $Comment->setId($rawComment['id']);
//             $Comment->setcomment($rawComment['comment']);
//             // $Comment->setcreatedAt($rawComment['createdAt']);
//             $Comment->setidGameCom($rawComment['game_id']);
//             $Comment->setidUserCom($rawComment['user_id']);
                
//             $tabComment[] = $Comment;
//             return $tabComment;
//         }

//         var_dump($tabComment);

//         // $Coment = new Comment();

        


//         // $query = $this->database->prepare('SELECT gameName FROM games WHERE id = :id');
//         // $query->execute([
//         //     'id' => $tabComment['game_id']

//         // ]);

//         // $rawGamecom = $query->fetch(PDO::FETCH_ASSOC);

//         // $gameName= $Coment-> setGameName($rawGamecom['gameName']);
//         // $tabComment[]=$gameName;



//         // $query = $this->database->prepare('SELECT lastName FROM users WHERE id = :id');
//         // $query->execute([
//         //     'id' => $tabComment['user_id']

//         // ]);

//         // $rawUsercom = $query->fetch(PDO::FETCH_ASSOC);

//         // $userName =$Coment-> setUserName($rawUsercom['lastName']);
        
//         // $tabComment[]=$userName;
// // var_dump($Comments);

//         return $tabComment;
//     }



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
