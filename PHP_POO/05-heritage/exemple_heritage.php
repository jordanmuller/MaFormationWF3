<?php

class Membre
{
    public $id_membre;
    public $pseudo;
    public $email;

    public function seConnecter()
    {
        return 'Je me connecte !';
    }

    public function inscription()
    {
        return 'Je m\'inscris !';
    }
}
// -----------
// La classe admin hérite de la classe Membre
class Admin extends Membre
{
    // C'est comme ci ici tout le code de Membre était présent ici

    public function accesBackOffice()
    {
        return 'J\'ai accès au BO !';
    }
}

$membre = new Membre;
$admin = new Admin;
echo $admin->seConnecter() . '<br />';
echo $admin->inscription() . '<br />';
echo $admin->accesBackOffice() . '<br />';

/*
Commentaires :
    Dans notre site un admin est vant tout un Membre, avec une ou plusieurs fonctionnalités supplémentaires.
    Il est donc naturel que la classe Admin extends la classe Membre et qu'on ne ré-écrive pas tout le code deux fois.
*/