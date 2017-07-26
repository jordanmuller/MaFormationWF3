<?php

abstract class Joueur 
{
    public function seConnecter()
    {
        return $this->etreMajeur();
    }

    // Une fonction abstraite n'a pas de corps !, elle n'est pas composée d'accolades
    abstract public function etreMajeur();
}
// ----------------------------
class JoueurFr extends Joueur
{
    // On est obligé de déclarer la fonction abstraite de la classe mère dans la classe héritière
    public function etreMajeur()
    {
        return 18;
    }
}
// ---------------------------
class JoueurUs extends Joueur
{
    public function etreMajeur()
    {
        return 21;
    }
}
// On ne peut pas instancier un objet à partir d'une abstract class
// $joueur = new Joueur;

/*
Commentaires:
    - Une classe abstraite ne peut pas être instanciée
    - Les méthodes abstraites n'ont de contenu
    - Les méthodes abstraites sont OBLIGATOIREMENT dans une classe abstraite
    - Lorsqu'on hérite d'une classe abstraite on DOIT OBLIGATOIREMENT redéfinir les méthodes abstraites
    - Une classe abstraite peut contenir des méthodes normales

    Le développeur qui écrit une classe abstraite est souvent au coeur de l'application. Il va obliger les autres dèv' à redéfinir des méthodes.
    CECI EST UNE BONNE CONTRAINTE !
*/