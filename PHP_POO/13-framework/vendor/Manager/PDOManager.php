<?php

namespace Manager;

// On a besoin d'utiliser PDO qui existe dans l'exspace global de PHP et non dans ce namespace Manager
use PDO;

class PDOManager
{
    private static $instance = NULL;
    private $pdo; //Contiendra notre connexion à la BDD

    private function __construct() {}
    private function __clone() {}

    public static function getInstance() 
    {
        if(!self::$instance)
        {
            self::$instance = new self;
        }
        return self::$instance;
    }

    public function getPdo()
    {
        require_once __DIR__ . '/../../app/Config.php';
        $config = new \Config;
        $connect = $config->getParametersConnect();

        // Connexion à la BDD en affectant à la propriété $pdo les valeurs passés dans l'indice connect du tableau array parameters dans le fichier parameters.php
        $this->pdo = new PDO('mysql:host=' . $connect['host'] . ';dbname=' . $connect['dbname'], $connect['login'], $connect['password'], array(
            PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING,
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
        ));

        return $this->pdo;
    }
}