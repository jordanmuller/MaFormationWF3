<?php

// Transitivité : Si B hérite de A et que C hérite de B, alors C hérite de A.

// Normalement on écrit UNE class pour UN fichier, ici c'est un exercice

class A
{
    public function test()
    {
        return 'test';
    }
}

class B extends A 
{
    public function test2()
    {
        return 'test 2';
    }
}

class C extends B 
{
    public function test3()
    {
        return 'test 3';
    }
}

// -----------------
$c = new C; 
echo $c->test(); // Méthode de A accessible par C (héritage indirect)
echo $c->test2(); // Méthode de B accessible par C (héritage direct)
echo $c->test3(); // Méthode de C accessible par C
echo '<hr />';
var_dump(get_class_methods($c)); // Nous retourne test, test2, test 3

/*
Commentaires : 
    La transitivité :
        Si B hérite de A...
            et que C hérite de B...
                Alors C hérite de A (indirectement)
    ---> Les méthodes protected de A sont également accessibles dans C (pourtant l'héritage est indirect).

    L'héritage n'est pas :
        -> reflexif : class D extends D : Ce n'est pas possible, une classe ne peut pas hériter d'elle même.
        -> Symétrique (réciproque) : Ce n'est pas parce que class E extends F, que F extends E automatiquement
        -> Cyclique: Si Y extends X, alors il est impossible que X extends Y
        -> Multiple : class N extends O, M : En PHP ce n'est pas possible. Pas d'héritage multiple en PHP, mais cela existe dans d'autres langages

    Une classe peut avoir un nombre infini d'héritiers
*/
