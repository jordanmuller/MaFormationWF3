<?php

final class Application
{
    public function run()
    {
        return 'L\'apllication se lance';
    }
}
// Une classe finale peut être instanciée
$app = new Application;
$app->run();

// class Extension extends Apllication; // Une classe finale ne peut pas être héritée

// -----------------------
class Application2
{
    final public function run2()
    {
        return 'L\'apllication se lance';
    }
}
class Extension2 extends Application2
{
    // public function run2(){} // Une méthode finale ne peut pas être redéfinie, ni surchargée
}

/*
Commentaires :
    - Une classe finale ne peut pas être héritée, en revanche elle peut être instanciée
    - Une méthode finale peut être présente dans une classe normale
    - Une méthode finale ne peut pas être surchargée, ni redéfinie
*/