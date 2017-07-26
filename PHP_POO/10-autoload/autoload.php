<?php

function inclusion_automatique($className)
{
    // La classe A est dans le fichier A.class.php
    require $className . '.class.php';

    echo 'On passe dans l\'autolaod<br>';
    echo 'On fait un require ' . $className . '.class.php<br />';
}

// -----------------------------
spl_autoload_register('inclusion_automatique');
// -----------------------------
/*
Commentaires :
    spl_autoload_register :
        - Est une fonction super pratique qui va s'effectuer lorsqu'elle voit passer le mot-clé "new"
        - Elle va lancer une fonction, celle que nous allons lui préciser en argument
        - Elle va apporter en argument à ma fonction le(s) qui suit le mot-clé "new"
        -->C'est à dire le nom de la classe
*/