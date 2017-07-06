<?php

$affichage = "";
// On instancie (crée) l'objet $date à partir de la classe DateTime()
$date = new DateTime();
// On lui assigne une date avec la méthode setDate() au format anglais
$date->setDate(1992, 4, 12);

// On observe que $date est bien un objet instancié par la classe dateTime()
// var_dump($date);

// On crée un tableau array en choisissant nous-mêmes les indices et en leur affectant des valeurs
$tableau = array('Prénom' => 'Jordan', 'Nom' => 'Muller', 'Adresse' => 'rue du Tertre', 'Code postal' => 75000, 'Ville' => 'Paris', 'Email' => 'jordan@mail.fr', 'Téléphone' => '0607080910', 'Date de naissance' => date_format($date, 'd/m/Y')); //date_format permet de formater l'affichage de la date aux normes françaises

$affichage .= '<ul>';
// On parcourt le tableau array à l'aide d'un foreach()
foreach($tableau AS $indice => $info)
{
    $affichage .= '<li><b>' . $indice . ':</b> ' . $info . '</li>';
}
$affichage .= '</ul>';

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Exercice 1</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

</head>
    <body>
        <div class="container"> 
            <h1 class="text-center">Exercice 1</h1><br />
            <?php echo $affichage; ?>
        </div>
    </body>
</html>