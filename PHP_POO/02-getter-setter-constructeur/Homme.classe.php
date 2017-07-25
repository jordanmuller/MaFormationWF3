<?php

class Homme 
{
    // Le prénoms et le nom sont en private, on doit les manipuler avec un setter pour affecter une valeur et un getter pour l'afficher à partir d'un objet instancié
    private $prenom;
    private $nom;

    // Pour récuprer la valeur de la propriété $prenom. Le getPrenom() NE PREND JAMAIS D'ARGUMENT
    public function getPrenom()
    {
        // $this fait référence à l'objet qui est en train d'utiliser la méthode et NON à la classe 
        return $this->prenom;
    }
    // Pour affecter une valeur à la propriété $prenom, qui est en private. le setPrenom() attent toujours un ou plusieurs arguments
    public function setPrenom($arg)
    {
        // On place les vérifications directement dans setPrenom
        if(!empty($arg) && iconv_strlen($arg) > 3 && iconv_strlen($arg) < 20 && is_string($arg))
        {
            // Si les vérifications sont correctes on affecte la valeur à l'objet instancié par la class Homme. On utilise this pour que cela s'applique à TOUS les objets qui sont uniques et interdépendants les uns entre les autres et qui auront cette méthode commune
            $this->prenom = $arg;
        } else {
            // Sinon on retourne false
            return false;
        }
    }
    public function getNom()
    {
        return $this->nom;
    }
    public function setNom($arg)
    {
        if(!empty($arg) && iconv_strlen($arg) > 5 && iconv_strlen($arg) < 20 && is_string($arg))
        {
            $this->nom = $arg;
        } else {
            return false;
        }
    }
}


// ----------------
$homme = new Homme;
// $homme->prenom = "Jordan"; ::La propriété $prenom étant private, je n'ai pas accès à l'extérieur de la classe (en dehors des accolades de la classe)
$homme->setPrenom('Jordan');
echo 'prenom : ' . $homme->getPrenom() . '<br />';

// On peut s'en servir  pour récupérer et affecter la vlaeur d'un champ d'un formulaire par exemple
$_POST['prenom'] = "Jordan";
$homme->setPrenom($_POST['prenom']);
echo 'Votre prénom est : ' . $homme->getPrenom() . '<br />';

/*
Commentaires:
    Pourquoi faire des getter et des setter ?
        - Le PHP est un langage qui ne type pas ses variables. Il faut donc constamment vérifier l'intégriter de celles-ci. Donc mettre une propriété en private, et créer les getter et setter, permet de vérifier une seule fois l'intégriter des données.
        - Tout dév qui voudra affecter une valeur DEVRA OBLIGATOIREMENT passer par le setter
        - CECI EST UNE BONNE CONTRAINTE !

    $this représente l'objet en cours de manipulation

    setter: affecter une valeur
    getter : Récupérer la valeur

    Nous aurons autant de Getter/setter que de propriétés private
*/
