<?php

// Design pattern (Les patrons de conception) : C'est une réponse trouvée par d'autres développeurs à un problème nrencontré par la communauté

// Singleton : C'est la réponse à la question suivante, comment faire pour créer une classe qui ne peut être instanciable QU'UNE SEULE ET UNIQUE FOIS ? (créer un seul objet, pour la connexion à la bdd par exemple)

class Singleton 
{   
    // Les 10 premières de la classe Singleton sont toujours les mêmes
    private static $instance = NULL; // D'abord NULL puis va contenir l'unique objet de la classe Singleton
    private function __construct() {} // fonction private, donc la classe ne peut pas être instanciée...
    // Fonction magique clone qui permet de cloner un objet, ici impossible car la fonction est private
    private function __clone() {} // Fonction private donc l'objet de la classe ne pourra pas être cloné
    
    public static function getInstance()
    {
        if(is_null(self::$instance)) // On peut aussi écrire (!self::$instance)
        { 
            self::$instance = new Singleton;
            // self::$instance = new self;
        }
        return self::$instance;
    }
}
// ---------------------
// $singleton = new Singleton; //Impossible !


$objet = Singleton::getInstance();
$objet2 = Singleton::getInstance();

echo '<pre>';
var_dump($objet);
// Il nous renvoie toujours le premier objet
var_dump($objet2);
echo '<pre>';