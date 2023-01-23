<?php

class Model 
{

    private static $pdo;

    private static function setBdd()
    {
        self::$pdo = new PDO('mysql:host=localhost;port=3306;dbname=biblio1;charset=utf8', '****', '****');
        self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
    }

    protected function getBdd()
    {
        if(self::$pdo === NULL)
        {
            self::setBdd();
        }
        return self::$pdo;
    }

}