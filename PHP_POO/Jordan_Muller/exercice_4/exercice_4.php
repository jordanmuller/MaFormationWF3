<?php

class Chat
{
    private $prenom;
    private $age;
    private $couleur;
    private $sexe;
    private $race;

    public function __construct($prenom, $age, $couleur, $sexe, $race)
    {
        $this->setPrenom($prenom);
        $this->setAge($age);
        $this->setCouleur($couleur);
        $this->setSexe($sexe);
        $this->setRace($race);
    }

    public function getPrenom()
    {
        return $this->prenom;
    }
    
    public function setPrenom($prenom)
    {
        if(iconv_strlen($prenom) >= 3 && iconv_strlen($prenom) <= 20 && is_string($prenom))
        { 
            $this->prenom = $prenom;
        } else {
            return false;
        }
    }

    public function getAge()
    {
        return $this->age;
    }
    
    public function setAge($age)
    {
        if(is_numeric($age))
        { 
            $this->age = $age;
        } else {
            return false;
        }
    }

    public function getCouleur()
    {
        return $this->couleur;
    }
    
    public function setCouleur($couleur)
    {
        if(iconv_strlen($couleur) >= 3 && iconv_strlen($couleur) <= 10 && is_string($couleur))
        { 
            $this->couleur = $couleur;
        }
    }

    public function getSexe()
    {
        return $this->sexe;
    }
    
    public function setSexe($sexe)
    {
        if($sexe == 'male' || $sexe == 'femelle' && is_string($sexe))
        { 
            $this->sexe = $sexe;
        } else {
            return false;
        }
    }
    public function getRace()
    {
        return $this->race;
    }
    
    public function setRace($race)
    {
        if(iconv_strlen($race) >= 3 && iconv_strlen($race) <= 20 && is_string($race))
        { 
            $this->race = $race;
        } else {
            return false;
        }
    }

    public function getInfos()
    {
        $affichage = '';
        $infos = array();
        $infos['prenom'] = $this->getPrenom();
        $infos['age'] = $this->getAge();
        $infos['couleur'] = $this->getCouleur();
        $infos['sexe'] = $this->getSexe();
        $infos['race'] = $this->getRace();
    
        foreach($infos AS $info)
        {
             $affichage .= '<td style="padding: 10px;">' . $info . '</td>';
        }
        
        echo $affichage;
    }
}

