<?php
// On appelle le fichier contenant la connexion BDD ainsi que le lancement d'une session
require_once("inc/init.inc.php");

$tab = array();
$tab['resultat'] = "";
// Rajout d'un indice dans le tableau array qui sera renvoyé nous permettant de faire un contrôle sur la disponibilté du pseudo, on pourra ainsi le tester sur index.php en JS
$tab['pseudo'] = "disponible";

// variable de contrôle en cas d'erreur
$erreur = false;

// Ecriture ternaire avec ou sans parenthèses
$pseudo = isset($_POST['pseudo']) ? $_POST['pseudo'] : "";
$sexe = isset($_POST['sexe']) ? $_POST['sexe'] : "";
$ville = isset($_POST['ville']) ? $_POST['ville'] : "";
$date_de_naissance = isset($_POST['date_de_naissance']) ? $_POST['date_de_naissance'] : "";


// requête en bdd pour vérifier si le pseudo existe déjà.
$resultat = $pdo->prepare("SELECT * FROM membre WHERE pseudo = :pseudo");
$resultat->bindParam(":pseudo", $pseudo, PDO::PARAM_STR);
$resultat->execute();
// Fetch
$membre = $resultat->fetch(PDO::FETCH_ASSOC);

// Vérification si le pseudo existe déjà, égalité stricte car la requête doit être égal à 0, dans ce cas il n'existe pas
if ($resultat->rowCount() === 0)
{
    // Ici le pseudo n'existe pas car nous n'avons pas récupéré au moins une ligne
    $inscription = $pdo->prepare("INSERT INTO membre (pseudo, sexe, ville, date_de_naissance, ip, date_connexion) VALUES (:pseudo, :sexe, :ville, :date_de_naissance, :ip, NOW())");
    $inscription->bindParam(":pseudo", $pseudo, PDO::PARAM_STR);
    $inscription->bindParam(":sexe", $sexe, PDO::PARAM_STR);
    $inscription->bindParam(":ville", $ville, PDO::PARAM_STR);
    $inscription->bindParam(":date_de_naissance", $date_de_naissance, PDO::PARAM_STR);
    $inscription->bindParam(":ip", $_SERVER['REMOTE_ADDR'], PDO::PARAM_STR); // $_SERVER['REMOTE_ADDR'] => adresse ip de l'utilisateur
    $inscription->execute();

    // On récupère l'id inséré pour le placer dans un deuxième temps dans la session pour pouvoir mettre à jour l'adresse ip
    $id_membre = $pdo->lastInsertId();
}
elseif ($resultat->rowCount() > 0 && $membre['ip'] == $_SERVER['REMOTE_ADDR'])
{
    // si rowCount() > 1 alors le pseudo existe mais il est possible que ce soit la même personne. On compare donc l'adresse ip en cours $_SERVER['REMOTE_ADDR'] avec l'adresse ip enregistrée dans la BDD $membre['ip']
    // On met à jour la date de connection
    $id_membre = $membre['id_membre'];
    $pdo->query("UPDATE membre SET date_connexion = NOW() WHERE id_membre = $id_membre");
}
else {
    // Si on rentre dans ce else, le pseudo existe déjà et l'adresse ip n'est pas la même que celle pré-enregistrée
    $tab['resultat'] = '<p style="color: red;">Ce pseudo est déjà utilisé, veuillez en choisir un autre !</p>';
    // On modifie la valeur de $erreur qui sera testée ensuite
    $erreur = true;

    // On change la valeur de $tab['pseudo'] afin de savoir s'il y a une erreur via JS sur index.php
    $tab['pseudo'] = "reserve";
}

// Vérification s'il n'a pas eu d'erreur au préablable
if(!$erreur)
{
    // On inscrit dans la session des informations sur l'utilisateur
    $_SESSION['utilisateur'] = array();
    $_SESSION['utilisateur']['pseudo'] = $pseudo;
    $_SESSION['utilisateur']['sexe'] = $sexe;
    $_SESSION['utilisateur']['id_membre'] = $id_membre;
    
    // Création d'un fichier pour inscrire les utilisateurs présents sur le tchat
    $f = fopen("pseudo.txt", "a");

    // Avant d'enregistrer l'information, on regarde si le fichier à une taille = 0, si c'est le cas alors c'est la première ligne du fichier
    if(filesize("pseudo.txt") === 0)
    {
        fwrite($f, $pseudo);
    }
    else {
        // Si on entre ici, il y a déjà des personnes inscrites dans le fichier, on commence par sauter une ligne
        fwrite($f, "\n" . $pseudo);
        // Il faut l'ouvrir avec un éditeur de texte propre, par Wordpad
    }
}
echo json_encode($tab);