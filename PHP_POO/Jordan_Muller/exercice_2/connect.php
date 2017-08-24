<?php

// Connexion à la base de données userslist, on attribue un mode d'erreur à PDO et on encode les tésultats des requêtes sql en utf-8
$db = new PDO('mysql:host=localhost;dbname=exo1_userslist', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));