<?php

class Animal
{
    protected function deplacement()
    {
        return 'Je me déplace !<br />';
    }
    public function manger()
    {
        return 'Je mange !<br />';
    }
}

// ------------------
class Elephant extends Animal
{
    public function quiSuisJe()
    {
        // Je peux appeler la méthode déplacement avec $this-> car on hérite des méthodes protected
        return 'Je suis un éléphant et ' . $this->deplacement();
    }
}



class Chat extends Animal
{
    public function quiSuisJe()
    {
        return 'Je suis un chat !<br />';
    }

    public function manger()
    {
        // La fonction manger existe déjà dans la classe mère (Animal). Mais puisque mon entité Chat a des caractéristiques particulières (manger peu), on peut REDEFINIR une méthode héritée
        return 'Je mange peu... Car je suis un chat !<br />';
    }
}
// -----------------------------
$elephant = new Elephant;
echo $elephant->quiSuisJe();
echo $elephant->manger();
// Je ne peux pas écrire
// $elephant->deplacement()

$chat = new Chat;
echo $chat->quiSuisJe();
// L'interpréteur regarde déjà dans la classe Enfant pour trouver la méthode manger, si elle n'existe pas il regarde dans la class mère
echo $chat->manger();

/*
Commentaire:
    L'héritage est un des fondements de la programmation orientée objet
    Lorsqu'une classe hérite d'une autre classe, elle importe tout le code. Les éléments sont donc appelés avec $this->(à l'intérieur de la classe)

    REDEFINITION: Une class enfant (héritière) peut modifier ENTIEREMENT le comportement d'une méthode dont elle a héritée. Lors de l'execution, l'interpréteur va dans un premier temps regarder dans la class enfant si la méthode existe... Puis dans la classe Mère

    L'interpréteur est le serveur Apache

    REDEFINITION != SURCHAGE (voir chapitre 6)
*/