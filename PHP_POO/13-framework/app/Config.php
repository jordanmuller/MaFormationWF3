<?php

class Config
{
    protected $parameters;

    public function __construct()
    {
        // DIR renvoie au dossier du fichier courant, ici C:\xampp\ .... \app, car __DIR__ ne contient pas le slash final
        // echo __DIR__;
        require __DIR__ . '/Config/parameters.php';
        // Au moment où j'instancie ma classe Config, je récupère les paramètres de connexion à la BDD pour les stocker dans la propriété $parameters.
        $this->parameters = $parameters;
    }

    public function getParametersConnect()
    {
        // Cette fonction me retourne seulement la partie connexion des paramètres, elle sera utile à PDOManager.
        return $this->parameters['connect'];
    }
}
/*
$config = new Config;
echo '<pre>';
print_r($config->getParametersConnect());
echo '</pre>';
*/