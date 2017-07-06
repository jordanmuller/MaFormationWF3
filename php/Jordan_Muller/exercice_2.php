<?php

// On crée la fonction convertir en lui passant deux paramètres
function convertir($montant, $devise_sortie)
{
    // On récupère le script cgi de http://www.xe.com/ qui nous fournit le taux de change euro/dollar USD
    $file = file_get_contents('http://www.xe.com/ucc/convert.cgi?Amount=1&From=EUR&To=USD');
    // Expression régulère
    preg_match('`([0-9.]+) USD`i', $file, $devise);
    
    // On enregistre le taux de change dans une variable
    $taux_de_change = $devise[1];
    
    // Si les deux variables sont de type numérique, soit des nombres ou des chaînes numériques
    if(is_numeric($montant) && is_numeric($taux_de_change))
    {
        if($devise_sortie == 'USD')
        {         
            $montant_us = $montant * $taux_de_change;
            echo $montant . ' euro(s) = ' . $montant_us . ' dollar(s) américain(s).<br />';
        }
        elseif($devise_sortie == 'EUR')
        {
            $montant_euro = $montant / $taux_de_change;
            echo $montant . ' dollar(s) américain(s) = ' . $montant_euro . ' euro(s).<br />'; 
        } else {
            echo '<p>Les paramètres d\'entrée de la fonction ne sont pas valides</p>';
        }     
    } else {
        echo '<p>Les paramètres d\'entrée de la fonction ne sont pas valides</p>';
    }     
}

// Vérification du script récupéré en dehors de la fonction

/*$file = file_get_contents('http://www.xe.com/ucc/convert.cgi?Amount=1&From=EUR&To=USD');
preg_match('`([0-9.]+) USD`i', $file, $devise);
echo '1€ = '.$devise[1].'$';

// On vérifie le type de $devise
echo '<pre>'; var_dump($devise); echo '</pre>';

$taux_de_change = $devise[1];
// On vérifie l'affichage et le type de $taux_de_change
echo $taux_de_change;
echo '<pre>'; var_dump($taux_de_change); echo '</pre>';*/
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Exercice 2</title>
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    </head>
    <body>
        <div class="container">
            <h1 class="text-center">Exercice 2</h1><br />
            <?php
                // Appel de la fonction convertir() qui affiche les valeurs passés en paramètre, le chargement du script cgi n'est pas des plus rapides
                convertir(50, 'USD');
                convertir(122, 'EUR');
                convertir(1000, 'EUR');

                // Tests d'erreur
                // convertir(122, 'BSD');
                // convertir('aaa', 'USD');
            ?>
        </div>
    </body>
</html>