<?php

abstract class AbstractManager
{
    protected PDO $database;

    public function __construct()
    {
        $userLog = 'stephanensimba';
        $pass = '1c8fd063c968dbb87fc737b4f9b399a3';


        $this->database = new PDO('mysql:host=db.3wa.io;port=3306;dbname=stephanensimba_Projet3w', $userLog, $pass, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
        ]);
    }
}
