<?php

interface Mouvement
{
    public function start();
    public function turnLeft();
    public function turnRight();
}
// On peut aussi extends une class // class Bateau extends Vehicule implements Mouvement
class Bateau implements Mouvement
{
    public function start()
    {
        // Traitement de la méthode
    }

    public function turnLeft()
    {

    }
    public function turnRight()
    {

    }
}

class Avion implements Mouvement
{
    public function start()
    {
        // Traitement de la méthode
    }
    
    public function turnLeft()
    {

    }
    public function turnRight()
    {

    }
}

/*
Commentaires :
    - Une interface est une liste de méthodes sans contenu qui permettent de garantir que toutes les classes qui implémentent l'interface contiennent les mêmes méthodes 
    - Cela garantit une convention de nommage. C'est une sorte de contrat passé entre le dèv mettre de l'application et les autres

    - Une interface n'est pas instanciable
    - Par exemple : Bateau et Avion, appartiennent au groupe "Véhicule" (héritage), et partagent un point commun "Mouvement" (implements)
    
    - Il est possible d'implémenter plusieurs interfaces (class H implements I, J)
    - Une classe peut héritée d'une autre classe et en même temps implémenter plusieurs interfaces.
    - Les méthodes d'une interface sont forcément public, sinon elles ne pourraient pas être redéfinies 
*/