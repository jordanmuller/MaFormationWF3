<?php

class A
{
    public function direBonjour()
    {
        return 'Bonjour !';
    }
}
// ------------------
class C {}
// -------------------
class B extends C // B hérite de C.... donc ne peut pas hériter de A
{
    // Contient un objet de la class B
    public $maVariable;

    public function __construct()
    {
        // Au moment on l'on construit la classe B
        $this->maVariable = new A; 
    }
}

$b = new B;
echo $b->maVariable->direBonjour();
// echo objet_de_la_classe_A->direBonjour();

/*
Commentaires :
    Nous avons un objet dans un objet

    L'intérêt d'avoir une instance sans héritage (récupérer un objet dans la propriété d'une classe) et de pouvoir hériter d'une classe mère d'un côté tout en ayant la possibilité de récupérer les éléments d'une autre classe en même temps
*/