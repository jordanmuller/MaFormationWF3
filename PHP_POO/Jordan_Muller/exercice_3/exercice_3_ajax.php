<?php
// Connexion à la bdd vehicule
$pdo = new PDO('mysql:host=localhost;dbname=vehicule', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));

// On crée un tableau array dont l'indice résultat comportera la réponse renvoyée par la requête ajax
$tab = array();
$tab['resultat'] = ""; 

// Récupération des arguments dans post via notre requête ajax (variable param)
$marque = (isset($_POST['marque'])) ? $_POST['marque'] : "";
$modele = (isset($_POST['modele'])) ? $_POST['modele'] : "";
$annee = (isset($_POST['annee'])) ? $_POST['annee'] : "";
$couleur = (isset($_POST['couleur'])) ? $_POST['couleur'] : "";


// Si les champs du formulaire existent et ne sont pas vides
if(!empty($marque) && !empty($modele) && !empty($annee) && !empty($couleur))
{
    
    // On récupère les valeurs des champs des formulaires dans des variables
    $insertion = $pdo->prepare("INSERT INTO voiture (marque, modele, annee, couleur) VALUES (:marque, :modele, :annee, :couleur)");
    $insertion->bindParam(':marque', $marque, PDO::PARAM_STR);
    $insertion->bindParam(':modele', $modele, PDO::PARAM_STR);
    $insertion->bindParam(':annee', $annee, PDO::PARAM_STR);
    $insertion->bindParam(':couleur', $couleur, PDO::PARAM_STR);
    $insertion->execute();

    $tab['resultat'] .= '<div class="alert alert-success" role="alert" style="margin-top: 20px;">Félicitations, votre voiture a bien été ajoutée !</div>';
} else {
    // Sinon on affiche un message d'erreur
    $tab['resultat'] .= '<div class="alert alert-danger" role="alert" style="margin-top: 20px;">Nous n\'avons pas pu valider l\'insertion de votre voiture. Veuillez remplir tous les champs</div>';
}
// json_encode() Transforme un tableau ARRAY (ici $tab) en format JSON qui sera interprété par notre script javascript
echo json_encode($tab);