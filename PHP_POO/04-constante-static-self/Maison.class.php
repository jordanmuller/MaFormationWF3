<?php

class Maison 
{
    // On peut mettre une valeur par défaut à une propriété, on le fait très rarement
    // La propriété $couleur appartient à l'objet
    public $couleur = 'blanc';
    // la propriété $espaceTerrain est de type static, elle appartient à la classe et non à l'objet
    // Les propriétés et les méthodes peuvent êtres static
    public static $espaceTerrain = '500m²';
    private $nbPorte = 10; //Appartient à l'objet
    private static $nbPiece = 7; // Appartient à la classe
    const HAUTEUR = '10m'; // Une constante s'écrit toujours en majuscule et appartient à la classe

    

    public function getNbPorte() 
    {
        return $this->nbPorte;
    }

    public function setNbPorte($nbPorte)
    {
        $this->nbPorte = $nbPorte;
    }

    // Le getter est toujours public, ici il faut aussi qu'il soit static, il appartient à la classe
    public static function getNbPiece()
    {
        // Pour les getter static, on utilise self qui renvoie à la classe, même chose que $this pour l'objet
        return self::$nbPiece;
        //  On peut aussi écrire le nom de la Classe mais à éviter
        // return Maison::$nbPiece; 
    }
}
// On appelle la classe Maison qui utilise sa propriété $espaceTerrain.
// Lorsqu'on affiche les propriétes d'une classe, on écrit le "$"
echo 'Terrain : ' . Maison::$espaceTerrain . '<br />'; // Ok j'accède à un élément public de la classe via la classe

echo 'Nombre de pièces : ' . Maison::getNbPiece() . '<br />'; // Ok j'accède à un élément private de la classe via un getter appartenant à la classe.

echo 'Hauteur : ' . Maison::HAUTEUR . '<br />'; // Ok j'accède à un élément appartenant à la classe via la classe
// Cela ressemble à fetch(PDO::FETCH_ASSOC) ou bindParam("", , PDO::PARAM_STR);

// -------------------------
$maison = new Maison;
// J'accède à une propriété public via l'objet
echo 'Couleur : ' . $maison->couleur . '<br />';

// echo 'Terrain : ' . $maison->espaceTerrain . '<br />'; // Erreur, j'essaie d'accéder à une propriété appartenant à la classe par l'objet

echo 'Nombre de portes : ' . $maison->getNbPorte() . '<br />'; // On accède bien à une propriété private, appartenant à l'objet, via un getter appartenant à l'objet

/*
Commentaires :
    Opérateurs :
        $objet->  permet d'accéder à un élément d'un objet à l'extérieur de la classe
        $this->   permet d'accéder à un élément d'un objet à l'intérieur de la classe
        Class::   permet d'accéder à un élément d'une classe à l'extérieur de la classe
        self::    permet d'accéder à un élément d'une classe à l'intérieur de la classe
        // parent:: (5ème opérateur plus rare)

    2 questions à se poser:
        - Est-ce que l'élément est static ?
            -> Si oui, (Class:: / self:: )
            -Est-ce que je suis à l'intérieur ou à l'extérieur de la classe ?
                -> Intérieur : self::
                -> Extérieur : Class::
            -> Si non ($objet-> / $this-> )
            - Est-ce que je suis à l'intérieur ou à l'extérieur de la classe ?
                -> Intérieur : $this->
                -> Extérieur : $objet->

    Static signifie qu'un élément appartient à la classe. Pour y accéder on devra donc l'appeler par les classe (Class:: ou self::). Une propriété static peut être modifiée et tous les objets qui suivront auront la nouvelle valeur (ex: singleton);

    Const signifie qu'une propriété appartient à la classe et qu'elle ne peut pas être modifiée
*/

