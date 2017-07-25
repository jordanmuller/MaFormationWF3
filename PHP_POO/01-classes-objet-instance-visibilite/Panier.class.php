<?php

/* En objet :
    Variable = Propriété
    Fonction = Méthode
*/

// On crée une classe, nom toujours en majuscule, Upper camelCase SteadyCase, snake_case. 
class Panier
{
    // public est une visibilité, une propriété par défaut est nulle (default: NULL), on peut affecter des valeurs que lors de l'instancication de l'objet
    public $nbProduit;

    // echo 'Bonjour' // Erreur, tout le code des classes doit être encapsulé dans des méthodes (fonctions)

    // On déclare toujours sa visibilité, fonction sans argument
    public function ajouterProduit() 
    {
        // Traitements de ma méthode
        return 'Le produit a été ajouté au panier !';
    }

    protected function retirerProduit()
    {
        return 'Le produit a été retiré du panier !';
    }

    private function affichagePanier() 
    {
        return 'Voici les produits dans le panier !';
    }
}
// -----------------------------
// On met ou non la parenthèse, la classe PDO() attendait des informations, des paramètres, ici la classe Panier n'en attend pas
$panier = new Panier;
echo '<pre>';
// #1 indique que c'est le premier objet instancié par la class Panier
// (1) indique le nombre de propriétés de l'objet
var_dump($panier);
var_dump(get_class_methods($panier));
echo '</pre>';

// J'affecte la valeur 5 à la propriété $nbProduit, lorsqu'on affecte une valeur à la propriété d'un objet, on l'appelle sans le "$"
$panier->nbProduit = 5;
echo 'Le nombre de produits dans le panier est ' . $panier->nbProduit . ' !<br />';

// Pour accéder au proprété d'un objet, on passe toujours par l'objet
// $nbProduit n'existe pas, echo $nbProduit renvoie error, on doit toujours écrir $panier->nom_propriete

// Lorsqu'on appelle une méthode, on doit toujours mettre les parenthèses propre à la méthode
echo 'Panier : ' . $panier->ajouterProduit() . '<br>';


/* echo 'Panier : ' . $panier->retirerProduit() . '<br>';
echo 'Panier : ' . $panier->affichageProduit() . '<br>'; */

// En l'état seuls les élements public sont accessibles...

$panier2 = new Panier;
echo '<pre>';
// #2 indique que c'est le deuxième objet instanciée par la class Panier
// La propriété nbPorduit est à nouveau NULL, chaque objet a ses particularités propres, on doit à nouveau réaffecter une valeur à nbProduit pour l'objet $panier2 spécifiquement
// Chaque objet est indépendant, $panier->nbProduit vaut toujours 5
var_dump($panier2);
echo '</pre>';

/*
Commentaires : 
    - new est un mot clé qui permet de créer un objet d'une classe, on parle d'instanciation
    - On peut créer plusieurs objets d'une même classe
    - Niveau de visibilité :
        --> public : Les éléments sont accessibles de partout
        --> protected : Les éléments sont accessibles à l'intérieur de la classe où ils ont été déclarés et à l'intérieur des classes héritières
        --> private : Les éléments sont accessibles UNIQUEMENT à l'intérieur de la classe où ils sont déclarés
*/


