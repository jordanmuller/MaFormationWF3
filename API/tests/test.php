<?php

    $pdo = new PDO('mysql:host=localhost;dbname=GetInspired', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));

    $affichage = $pdo->query("SELECT * FROM movies WHERE id_movie = 53");
    $aff = $affichage->fetch(PDO::FETCH_ASSOC);
    foreach($aff AS $detailAff)
    {
        echo $detailAff;
    }