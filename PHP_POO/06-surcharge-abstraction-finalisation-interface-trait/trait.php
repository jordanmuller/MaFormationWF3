<?php

// Attention les traits ne fonctionnent que depuis PHP5.4

trait TPanier
{
    public function affichage()
    {
        return 'Voici les produits dans le panier';
    }
}

trait TMembre
{
    public function affichageMembre()
    {
        return 'Voici le Membre !';
    }
}

class Site 
{
    use TPanier;
    use TMembre;
    // On peut écrire
    // use TPanier, TMembre;
    // Cela impote le code dans TPanier et TMembre
}

/*
Commentaires:
    - Les traits ont été inventés pour repousser l'héritage non multiple du PHP
    - Une classe peut héritée d'une seule classe mais elle peut importée plusieurs traits
    - Un trait peut importer un autre trait
*/