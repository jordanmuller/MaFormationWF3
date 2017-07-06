<?php
// Connexion BDD
$pdo = new PDO('mysql:host=localhost;dbname=crud', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8')); 

// Appel du fichier contenant toutes nos fonctions
require_once("function.inc.php");

// Ouverture de session
session_start();

// Déclaration de variable
$content = '';