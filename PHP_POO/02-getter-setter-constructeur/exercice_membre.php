<?php

class Membre
{
    // Deux propriétes private, pseudo et email
    private $pseudo;
    private $email;

    // fonction public pour récupérer le pseudo
    public function getPseudo() 
    {
        return $this->pseudo;
    }
    
    // fonction pour affecter une valeur au pseudo
    public function setPseudo($pseudo)
    {
        if(!empty($pseudo) && iconv_strlen($pseudo) > 3 && iconv_strlen($pseudo) < 20 && is_string($pseudo))
        {
            $this->pseudo = $pseudo;
        } else {
            return false;
        }
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        if(!empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL))
        {
            $this->email = $email;
        } else {
            return false;
        }
    }
}

$membre = new Membre;
$membre->setPseudo('jojo');
$membre->setEmail('jordan@mail.fr');
echo 'Bonjour ' . $membre->getPseudo() . ', votre adresse email est ' . $membre->getEmail() . '<br />'; 