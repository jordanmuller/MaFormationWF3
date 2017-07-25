<?php

class Vehicule
{
    private $litreEssence; // le contenu a un instant T
    private $reservoir; // 50 Capacité max du réservoir

    public function getLitreEssence()
    {
        return $this->litreEssence;
    }

    public function setLitreEssence($litre)
    {
        $this->litreEssence = $litre;
    }

    public function getReservoir()
    {
        return $this->reservoir;
    }

    public function setReservoir($capacite)
    {
        $this->reservoir = $capacite;
    }
}

class Pompe
{
    private $litreEssence; // 800 contenu a un instant T

    public function getLitreEssence()
    {
        return $this->litreEssence;
    }

    public function setLitreEssence($litre)
    {
        $this->litreEssence = $litre;
    }
    // L'argument est l'objet $vehicule de la classe Vehicule
    public function remplirVehicule(Vehicule $vehicule)
    {
        // Le volume d'essence à remplir dans la voiture
        $volume = $vehicule->getReservoir() - $vehicule->getLitreEssence(); 
        
        // Le nombre de litres de la pompe est recalculé
        $this->setLitreEssence($this->getLitreEssence() - $volume);

        // On remplit le réservoire de la voiture en lui affectant la nouvelle valeur par un setter
        $vehicule->setLitreEssence($vehicule->getLitreEssence() + $volume);
    }
}

$vehicule = new Vehicule;

$vehicule->setLitreEssence(5);
echo 'Nombre de litres dans le véhicule : ' . $vehicule->getLitreEssence() . '<br />';

$vehicule->setReservoir(50);
echo 'Capacité du réservoir : ' . $vehicule->getReservoir() . '<br />';

$pompe = new Pompe;

$pompe->setLitreEssence(800);
echo 'Nombre de litres disponibles dans la pompe : ' . $pompe->getLitreEssence() . '<br />';

// l'objet pompe utilise la méthode remplir véhicule sur l'objet voiture
$pompe->remplirVehicule($vehicule);

echo 'Le réservoir de la voiture possède ' . $vehicule->getLitreEssence() . ' litres d\'essence.<br />';
echo 'Il reste ' . $pompe->getLitreEssence() . ' litres d\'essence dans la pompe. <br />';