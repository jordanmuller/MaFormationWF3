<?php
/*
// ----------------------------------------
// PDO => Php Data Object

// méthode EXEC() (execution)
    INSERT, UPDATE, DELETE: exec() est une méthode de l'objet pdo qui est utilisée pour la formulation de requête ne retournant pas de résultat.

    Valeur de retour :
    succes => on obtient un entier (int) correspondant au nombre de lignes affectées.
    echec => On obtient le booléen false

// QUERY()
    INSERT, UPDATE, DELETE, SELECT, SHOW, ...: query() est utilisé pour tout type de requête.

    Valeur de retour :
    succes => On obtient un nouvel objet issu de la classe PDOStatement
    echec => On obtient le booléen false

// PREPARE() + EXECUTE() // Permet de sécuriser les données
    INSERT, UPDATE, DELETE, SELECT, SHOW, ...: prepare() permet de préparer la requête mais ne l'exécute pas; execute() exécute la requête

    prepare() => On obtient systématiquement un nouvel objet issu de la classe PDOStatement
    execute() 
        Valeur de retour :
        - succes => PDOStatement
        - echec => booléen false

    // Les requêtes préparées sont à préconiser pour sécuriser les données. => IMPORTANT       
    // Cela permet également d'éviter le cercle complet d'une requête: analyse / interprétation / exécution       gain de performance
*/      

// Pour générer une connexion à la base de données // $pdo, on peut l'appeler comme on veut, c'est la variable de réception

// 1 - Connexion à une BDD 
$pdo = new PDO('mysql:host=localhost;dbname=wf3_entreprise', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));

// arguments: 1 - ('serveur + nom_bdd') 2 - identifiant 3 - mot de passe 4 - options
// echo '<pre>'; var_dump($pdo); echo'</pre>'; 
// echo '<pre>'; var_dump(get_class_methods($pdo)); echo'</pre>'; 

// 2 - PDO: exec()
// Insert

// $resultat = $pdo->exec("INSERT INTO employes (prenom, nom, sexe, service, salaire, date_embauche) VALUES ('prenomtest7', 'nomtest', 'm', 'informatique', 2000, '2017-06-22'), ('prenomtest8', 'nomtest', 'm', 'informatique', 2000, '2017-06-22')"); // Dès que l'on raffraichit la page, l'insertion s'exécute à chaque fois, on la place donc en commentaire

// On place les requêtes sql entre guillemets, les valeurs entre quotes
// echo "nombre de lignes insérées par la dernière requête: " . $resultat . '<br />';

// 3 - PDO: QUERY => SELECT + FETCH (pour un seul résultat)
// On est obligés de mettre la query dans une variable résultat car on pose une question, ON UTILISE SELECT
$resultat = $pdo->query("SELECT * FROM employes WHERE id_employes=350");
echo '<pre>'; var_dump($resultat); echo'</pre>'; 
// echo '<pre>'; var_dump(get_class_methods($resultat)); echo'</pre>'; 

// En l'état, $résultat est inexploitable, nous devons le traiter avec la méthode fetch() afin de rendre les informations exploitables.
$info_employes = $resultat->fetch(PDO::FETCH_ASSOC); // FETCH_ASSOC pour un tableau array associatif (le nom des colonnes comme indices du tableau)

// $info_employes = $resultat->fetch(PDO::FETCH_NUM); // FETCH_NUM pour un tableau array numérique avec des indices, des index chiffrés

// $info_employes = $resultat->fetch(); // Par défaut, il effectue PDO::FETCH_BOTH
// $info_employes = $resultat->fetch(PDO::FETCH_BOTH); 
// FETCH_BOTH est un mélande de FETCH_ASSOC + FETCH_NUM

// $info_employes = $resultat->fetch(PDO::FETCH_OBJ); 

echo '<pre>'; print_r($info_employes); echo'</pre>'; 

echo $info_employes['prenom'] . '<br>'; // Avec FETCH_ASSOC  (ASSOC = associatif)
// echo $info_employes[1] . '<br>'; // Avec FETCH_NUM 
// echo $info_employes->prenom . '<br>'; // Avec FETCH_OBJ, on parcourt un objet ainsi objet->propriété quand les propriétés sont publiques

// $info_employes2 = $resultat->fetch(PDO::FETCH_ASSOC); // On ne peut pas faire plusieurs FETCH_ASSOC sur une même variable de résultat, cette ligne ne renverra rien, il faut refaire une query SELECT pour remplir $resultats


/*
$pdo représente un objet[1] issue de la classe prédéfinie PDO
Quand on execute une requete avec la méthode query sur notre objet $pdo:
On obtient un nouvel objet issu de la classe PDOStatement. Cet objet a donc des propriétés et méthodes différentes

- $resultat représente la réponse de la BDD et c'est un résultat inexploitable en l'état.
- $info_employes est la réponse exploitable (grâce au fetch())
- /!\ Attention il faut choisir l'un des traitements fetch (PDO::...) tableau associatif, tableau numérique, tableau objet
- Il n'est pas possible d'appliquer plusieurs traitements fetch sur un même résultat

- Le résultat est la réponse de la BDD et est inexploitable car Mysql nous renvoie beaucoup d'informations. Le fetch() permet de les organiser 
*/

// 4 - PDO: QUERY + WHILE + FETCH (plusieurs résultats)
$resultat = $pdo->query("SELECT * FROM employes");

echo 'Le nombre d\'employes: ' . $resultat->rowCount() . '<br />'; // La méthode rowCount() de l'objet PDOStatement retourne le nombre de lignes dans notre résultat.

while($info_employe = $resultat->fetch(PDO::FETCH_ASSOC))
{
    // A chaque tour de la boucle while, on traite avec un fetch() la ligne en cours et on passe à la suivante
    // echo '<pre>'; print_r($info_employe); echo '</pre><hr />';
    echo '<div style="box-sizing: border-box; padding: 10px; background-color: darkred; color: white; display: inline-block; width: 23%; margin: 1%;">';

    echo 'Id_employes: ' . $info_employe['id_employes'] . '<br />';
    echo 'Nom: ' . $info_employe['nom'] . '<br />';
    echo 'Prenom: ' . $info_employe['prenom'] . '<br />';
    echo 'Salaire: ' . $info_employe['salaire'] . '<br />';
    echo 'Sexe: ' . $info_employe['sexe'] . '<br />';
    echo 'Service: ' . $info_employe['service'] . '<br />';
    echo 'Date d\'embauche: ' . $info_employe['date_embauche'] . '<br />';

    echo '</div>';
}

// 5 - EXERCICE
// Récupérer la liste des BDD présentent sur le serveur
// Les traiter puis les afficher dans une liste ul li
// Attention à l'indice si vous utilisez FETCH_ASSOC (les indices sont sensibles à la casse) Sur cette requete il y a une majuscule dans l'indice récupéré


// On récupère la query SHOW DATABASES dans $resultat qui est inexploitable
$resultat = $pdo->query("SHOW DATABASES");
// echo '<pre>'; var_dump($resultat); echo '</pre>';

// On crée le tableau associatif $info_dbb en utilisant FETCH_ASSOC sur $resultat
$info_dbb = $resultat->fetch(PDO::FETCH_ASSOC);

// echo '<pre>'; print_r($info_dbb); echo '</pre>';

echo '<ul>';
while($info_dbb = $resultat->fetch(PDO::FETCH_ASSOC))
{
    echo '<li>' . $info_dbb['Database'] . '</li>';
}
echo '</ul>';