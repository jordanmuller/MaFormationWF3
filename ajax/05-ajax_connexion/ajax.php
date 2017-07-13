<?php
// Connexion à la bdd
$pdo = new PDO('mysql:host=localhost;dbname=connexion', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));



// Récupération des arguments dans post via notre requête ajax (variable param)
// éciture en ternaire
$pseudo = (isset($_POST['pseudo'])) ? $_POST['pseudo'] : "";
$mdp = (isset($_POST['mdp'])) ? $_POST['mdp'] : "";

/*
Ecriture classique
if(isset($_POST[pseudo]))
{
    $pseudo = $_POST['pseudo'];
}
else {
    $pseudo = "";
}
*/

// Déclaration d'un tableau array qui contiendra notre réponse à la requête ajax
$tab = array();
$tab['resultat'] = "OK"; 

if(!empty($pseudo) && !empty($mdp))
{
    // On fait une requête dans la bdd
    $connexion = $pdo->prepare("SELECT * FROM utilisateur WHERE pseudo = :pseudo AND mdp = :mdp");
    $connexion->bindParam(":pseudo", $pseudo, PDO::PARAM_STR);
    $connexion->bindParam(":mdp", $mdp, PDO::PARAM_STR);
    $connexion->execute();

    if($connexion->rowCount() > 0)
    {
        // Il n'a qu'une seule ligne, pas besoin de while
        $info = $connexion->fetch(PDO::FETCH_ASSOC);
            if($info['sexe'] == 'm')
            {
                $info['sexe'] = 'masculin';
            } else {
                $info['sexe'] = 'feminin';
            }
            // $sexe = ($info['sexe'] == 'm') ? 'masculin' : 'feminin';
            $tab['resultat'] .= '<p>Vous êtes connecté</p>';
            $tab['resultat'] .= '<p>Vous êtes ' . $info['pseudo'] . ', de sexe ' . $info['sexe'] . ', votre adresse email est ' . $info['email'] . '.</p>';   
        
    } else {
        $tab['resultat'] .= '<p>Vos identifiants sont incorrects</p>';
    }

}
// NE JAMAIS FAIRE D'echo avant l'encodage JSON sinon celui-ci ne s'effectue pas et la requête ajax ne reçoit pas de réponse
echo json_encode($tab);