<?php
// Récupération du choix de l\'utilisateur ou cas par défaut'

if(isset($_GET['langue']))
{
    $langue = $_GET['langue']; // choix de l'utilisateur
}


elseif(isset($_COOKIE['langue']))
{
    $langue = $_COOKIE['langue'];
}
else {
    $langue = 'fr'; // cas par défaut
    // Il est possible de récupérer la langue du navigateur de l'utilisateur
    // echo 'langue du navigateur: ' . substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2) . '<br />'; // cas par défaut
}
// Nombre de secondes dans un an
$un_an = 365 * 24 * 3600; 

// Creation d'un cookie sur le poste utilisateur
//  /!\ La fonction setCookie() doit être appelée avant tout affichage dans la page !!!
// Pour générer un cookie: 3 arguments => setCookie('nom', valeur, duree de vie);
setCookie('langue', $langue, time() + $un_an);
setCookie('categorie', 'pantalon', time() - 1); // Pour supprimer un cookie, on lui donne une durée de vie négative, ici time() - 1

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
                echo '<p>Hello, you\'re visiting our website in english tongue.</p>';
            break;    
            default:
                echo '<p>Langue inconnue</p>';
                break;
        }

        // Il est possible de récupérer la langue du navigateur de l'utilisateur
        echo 'langue du navigateur: ' . substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2) . '<br />'; // cas par défaut
        echo time(); // time() affiche la valeur du timestamp


        ?>
    </body>
</html>