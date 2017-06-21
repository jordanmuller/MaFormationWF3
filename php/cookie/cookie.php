<?php
// Récupération du choix de l\'utilisateur ou cas par défaut'
if(isset($_GET['langue']))
{
    $langue = $_GET['langue']; // choix de l'utilisateur
}
else {
    $langue = 'fr'; // cas par défaut
}

?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Document</title>
    </head>
    <body>
        <ul>
            <li><a href="?langue=fr">France</a></li>
            <li><a href="?langue=es">Espagne</a></li>
            <li><a href="?langue=it">Italie</a></li>
            <li><a href="?langue=en">Angleterre</a></li>
        </ul>

        <?php
        // Affichage d'un texte selon la langue, on est sûr que ['langue'] existe car elle est définie plus haut par une condition
        switch($langue) // On teste la valeur de langue
        {
            case 'fr':
                echo '<p>Bonjour vous visitez le site en langue française</p>';
            break;    
            case 'es':
                echo '<p>Hola vous visitez le site en langue française</p>';
            break;    
            case 'it':
                echo '<p>Ciao vous visitez le site en langue française</p>';
            break;    
            case 'en':
                echo '<p>Hello, you\'re visiting our website on english tongue.</p>';
            break;    
            default:
                echo '<p>Langue inconnue</p>';
                break;
        }
        ?>
    </body>
</html>