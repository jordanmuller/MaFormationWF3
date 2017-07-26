<?php

$pdo = new PDO('mysql:host=localhost;dbname=wf3_entreprise', 'root', '', array(
    PDO::ATTR_ERRMODE =>PDO::ERRMODE_EXCEPTION // On passe en mode exception au niveau de la BDD
));

try 
{ 
// Erreur de requête volontaire :
// $resultat = $pdo->query("sfsdds");
}
catch(PDOException $e)
{
    echo '<div style="background: red; color: white; padding: 10px;">Erreur SQL<br />Message : ' . $e->getMessage() . '<br />Fichier : ' . $e->getFile() . '<br />Ligne : ' . $e->getLine() . '</div>';
    // exit permet de stopper l'exécution du script si une exception est capturée
    exit;
}

// Exemple 1 : une seule valeur
$resultat = $pdo->prepare("SELECT * FROM employes WHERE prenom = ?");
// ? est un marqueur non-nominatif, on ne peut pas utiliser bindParam
$resultat->execute(array('Amandine'));

// Exemple 2 : plusieurs valeurs
$result = $pdo->prepare("SELECT * FROM employes WHERE prenom = ? AND service = ?");
// Les valeurs passées dans l'array doivent être dans l'ordre des "?"
$result->execute(array('Amandine', 'Communication'));

// Marqueur nominatif
$resultat = $pdo->prepare("SELECT * FROM employes WHERE prenom = :prenom AND service = :service");

$resultat->execute(array(
    ':service' => 'Communication',
    ':prénom' => 'Amandine'
    ));

/*$requete = "SELECT * FROM employes WHERE service = ?";
$resultat = $this->getDb()->fetchAll($requete, array('Communication'));*/

// Query + fetchAll à l'intérieur de la requête
$resultat = $pdo->query("SELECT * FROM employes", PDO::FETCH_ASSOC);

var_dump($resultat);

foreach($resultat AS $valeur)
{
    echo 'Prenom : ' . $valeur['prenom'] . '<br />';
}