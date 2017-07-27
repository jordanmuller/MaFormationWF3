<?php

namespace Entity;

class Commande
{
    private $id_commande;
    private $id_membre;
    private $montant;
    private $date_enregistrement;
    private $etat;

    public function getId_commande()
    {
        return $this->id_commande;
    }

    public function setId_Commande($arg)
    {
        $this->id_commande = $arg;
    }

    public function getId_Membre()
    {
        return $this->id_membre;
    }
    
    public function setId_Membre($arg)
    {
        $this->id_membre = $arg;
    }
    public function getMontant()
    {
        return $this->montant;
    }

    public function setMontant($arg)
    {
        $this->montant = $arg;
    }

    public function getDate_Enregistrement()
    {
        return $this->date_enregistrement;
    }
    
    public function setDate_Enregistrement($arg)
    {
        $this->date_enregistrement = $arg;
    }
    public function getEtat()
    {
        return $this->etat;
    }
    public function setEtat($arg)
    {
        $this->etat = $arg;
    }
}