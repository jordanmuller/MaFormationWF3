<?php
// Toutes nos fichiers dans le dossier Entity seront dans le namespace Entity
namespace Entity;

class Membre
{
    private $id_membre;
    private $pseudo;
    private $mdp;
    private $nom;
    private $prenom;
    private $email;
    private $sexe;
    private $ville;
    private $cp;
    private $adresse;
    private $statut;

    public function getId_membre()
    {
        return $this->id_membre;
    }

    public function setId_membre($arg)
    {
        $this->id_membre = $arg;
    }

    public function getPseudo()
    {
        return $this->pseudo;
    }
    
    public function setPseudo($arg)
    {
        $this->pseudo = $arg;
    }

    public function getMdp()
    {
        return $this->mdp;
    }

    public function setMdp($arg)
    {
        $this->mdp = $arg;
    }

    public function getNom()
    {
        return $this->nom;
    }
    
    public function setNom($arg)
    {
        $this->nom = $arg;
    }

    public function getPrenom()
    {
        return $this->prenom;
    }

    public function setPrenom($arg)
    {
        $this->prenom = $arg;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($arg)
    {
        $this->email = $arg;
    }
    
    public function getVille()
    {
        return $this->ville;
    }
    public function setVille($arg)
    {
        $this->ville = $arg;
    }

    public function getSexe()
    {
        return $this->sexe;
    }
    public function setSexe($arg)
    {
        $this->sexe = $arg;
    }
    public function getCp()
    {
        return $this->cp;
    }
    public function setCp($arg)
    {
        $this->cp = $arg;
    }
    public function getAdresse()
    {
        return $this->adresse;
    }
    public function setAdresse($arg)
    {
        $this->adresse = $arg;
    }
    public function getStatut()
    {
        return $this->statut;
    }
    public function setStatut($arg)
    {
        $this->statut = $arg;
    }
}