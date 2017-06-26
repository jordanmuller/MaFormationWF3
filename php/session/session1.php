<?php
// Pour voir les fichiers de session => dossier tmp à la racine du serveur (xampp, wamp, mamp ...)


// Pour créer une session 
session_start(); 
// Créer une session, si une section existe déjà, elle n'est pas écrasée, on ne fait que l'ouvrir
// Lors de la création d'une session, un cookie d'identifiant est créé côté utilisateur pour avoir le lien entre la session et l'utilisateur
// Comme pour setCookie(), la fonction sassion_start() doit être exécutée avant le moindre affichage html !!!

$_SESSION['pseudo'] = "Marie";
// $_SESSION est une superglobale donc un tableau array
// Il est donc possible de créer des indices avec des valeurs dans notre session
$_SESSION['password'] = "soleil";
$_SESSION['email'] = "mail@mail.fr";
$_SESSION['age'] = "25";
$_SESSION['adresse']['code_postal'] = 75000;
$_SESSION['adresse']['ville'] = 'Paris';
$_SESSION['adresse']['rue'] = 'rue du Tertre';

echo 'Premier affichage de la session: <br />';
echo '<pre>'; print_r($_SESSION); echo '</pre>';

// Pour supprimer un élément de la session:
unset($_SESSION['password']); // On supprime l'indice password

echo 'Deuxième affichage de la session:<br />';
echo '<pre>'; print_r($_SESSION); echo '</pre>';

// Permet de supprimer une session
session_destroy();
// Il faut savoir que l'information session_destroy() est vu par l'interpéteur php, mise de côté puis exécutée uniquement à la fin du script en cours !!!

echo 'Troisième affichage de la session après la session_destroy(): <br/>';
echo '<pre>'; print_r($_SESSION); echo '</pre>'; // La session sera affichée puis détruite après l'exécution de cette ligne