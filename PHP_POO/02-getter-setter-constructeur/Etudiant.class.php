<?php

class Etudiant
{
    private $prenom;

    // On écrit un constructeur en commençant par un double underscore, c'est ce qu'on appelle des méthodes magiques
    // Elles s'exécutent à un moment précis sans qu'on déclenche leur exécution
    // __construct s'exécute au moment de l'instanciation de l'objet
    public function __construct($argument)
    {
        $this->setPrenom($argument);
        // En plus long $this->prenom = $argument
    }

    public function getPrenom()
    {
        return $this->prenom;
    }
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;
    }
}
// ------------------
$etudiant = new Etudiant('Yakine');
echo $etudiant->getPrenom();

/*
Commentaires :
    - La méthode magique __construct() s'exécute automatiquement au moment de l'instanciation.
    - Il n'est pas obligatoire de la déclarer, en théorie on ne la déclare que si on a besoin d'automatiser un traitement
    - On l'utilise souvent pour déployer automatiquement notre application (instance sans héritage par exemple, voir chapitre 5)
    -Toutes les méthodes magiques s'écrivent avec le double "__"
*/

