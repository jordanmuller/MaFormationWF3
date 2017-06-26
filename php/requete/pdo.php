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

echo '<h1>1 - Connexion à une BDD</h1>'; 
$pdo = new PDO('mysql:host=localhost;dbname=wf3_entreprise', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));

// arguments: 1 - ('serveur + nom_bdd') 2 - identifiant 3 - mot de passe 4 - options
// echo '<pre>'; var_dump($pdo); echo'</pre>'; 
// echo '<pre>'; var_dump(get_class_methods($pdo)); echo'</pre>'; 

echo '<h1>2 - PDO: exec()</h1>';
// Insert

// $resultat = $pdo->exec("INSERT INTO employes (prenom, nom, sexe, service, salaire, date_embauche) VALUES ('prenomtest7', 'nomtest', 'm', 'informatique', 2000, '2017-06-22'), ('prenomtest8', 'nomtest', 'm', 'informatique', 2000, '2017-06-22')"); // Dès que l'on raffraichit la page, l'insertion s'exécute à chaque fois, on la place donc en commentaire

// On place les requêtes sql entre guillemets, les valeurs entre quotes
// echo "nombre de lignes insérées par la dernière requête: " . $resultat . '<br />';

echo '<h1>3 - PDO: QUERY => SELECT + FETCH (pour un seul résultat)</h1>';
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

// $info_employes = $resultat->fetch(PDO::FETCH_OBJ); Pour obtenir un objet avec les éléments disponibles en propriétés publiques

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

echo '<h1>4 - PDO: QUERY + WHILE + FETCH (plusieurs résultats)</h1>';
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

echo '<h1>5 - EXERCICE</h1>';
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

echo '<h1> 6 - PDO: QUERY + FETCHALL + FETCH_ASSOC (plusieurs résultats)</h1>';
$resultat = $pdo->query("SELECT * FROM employes");

//  fectAll, il transforme le résultat complet en tableau multidimensionnel
$liste_employes = $resultat->FETCHALL(PDO::FETCH_ASSOC);
echo '<pre>'; print_r($liste_employes); echo '</pre>'; echo '<hr>';
// fetchAll() traite toutes les lignes dans notre résultat et on obtient un tableau array multidimensionnel
// 1er niveau la ligne en cours, 2eme niveau les informations

foreach($liste_employes AS $valeur)
{
    echo $valeur['prenom'] . '<br />';
}

echo '<hr>';

echo '<h1>7 - PDO: QUERY + AFFICHAGE EN TABLEAU</h1>';

$contenu = $pdo->query("SELECT * FROM employes");

// Balise ouverture du tableau
echo '<table border="1" style="width: 80%; margin: 0 auto; border-collapse: collapse; text-align: center;">';

// Première ligne du tableau pour le nom des colonnes
echo '<tr>';
// récupération du nombre de colonnes dans la requête
$nb_col = $contenu->columnCount();

for($i = 0; $i < $nb_col; $i++)
{
    // echo '<pre>'; print_r($contenu->getColumnMeta($i)); echo '</pre>'; echo '<hr>';
    $colonne = $contenu->getColumnMeta($i); // On recupère les informations de la colonne en cours qui sont sous forme de tableau afin ensuite de demander le name. Pour chaque colonne.
    
    // On crée les en-têtes du tableau en récupérant le nom des colonnes de la bdd
    echo '<th style="padding: 10px;">' . $colonne['name'] . '</th>';
}
echo '</tr>';

// On parcourt $ligne du résultat de la requête dans $contenu
while($ligne = $contenu->fetch(PDO::FETCH_ASSOC))
{
    echo '<tr>';
        // On parcourt grâce à foreach tous les champs de chaque ligne de manière dynamique
        foreach($ligne AS $info)
        {
            echo '<td style="padding: 10px;">' . $info . '</td>'; 
            // On peut aussi faire à la main echo '<td>' . $contenu['id_employes'] . '</td>'; soit $contenu['nom_de_la_colonne']
            // On peut aussi faire à la main echo '<td>' . $contenu['nom'] . '</td>'; 
            // On peut aussi faire à la main echo '<td>' . $contenu['prenom''] . '</td>';
        }

    echo '</tr>';
}


echo '</table>';

// ------------------------------------------------------
// *************** SECURISATION DE DONNES ***************
// ------------------------------------------------------
echo '<h1> 8 - PDO: PREPARE + BINDPARAM + EXECUTE </h1>';

$nom = "Laborde";

$resultat = $pdo->prepare("SELECT * FROM employes WHERE nom = :nom");
// :nom est un marqueur nominatif

// Nous pouvons maintenant fournir la valeur du marqueur :nom
$resultat->bindParam(":nom", $nom, PDO::PARAM_STR); 
// bindParam(nom_du_marqueur, valeur_du_marqueur, type _attendu)
$resultat->execute();
$donnees = $resultat->fetch(PDO::FETCH_ASSOC);
echo '<pre>'; print_r($donnees); echo '</pre>';

// bindParam n'accepte que des valeurs sous forme de VARIABLE !!!

// implode() & explode() (fonctions prédéfinies)
// implode() permet d'afficher tous les éléments d'un tableau array séparées par un séparateur fourni en 2eme argument
// explode() découpe une chaîne de caractères selon un séparateur fourni en 2eme argument et place chaque segment de cette chaîne dans un tableau array, à des indices différents
// exemple:
echo implode($donnees, '<br />');

echo '<h1>8 - PDO: PREPARE + BINDVALUE + EXECUTE</h1>';
echo '<hr /><hr />';
$resultat = $pdo->prepare("SELECT * FROM employes WHERE nom = :nom");
// nom est un marqueur nominatif
$resultat->bindValue(":nom", "Laborde", PDO::PARAM_STR); //Il existe aussi PARAM_INT pour filtrer les entiers
$resultat->execute();
$donnees = $resultat->fetch(PDO::FETCH_ASSOC);


$resultat2 = $pdo->prepare("SELECT * FROM employes WHERE id_employes = :id");
$resultat2->bindValue(":id", 350, PDO::PARAM_INT);
echo '<pre>'; print_r($donnees); echo '</pre>';

$resultat2->execute();
$donnees2 = $resultat2->fetch(PDO::FETCH_ASSOC);
echo '<pre>'; print_r($donnees2); echo '</pre>';

// BindValue accepte une variable ou la valeur directement pour le marqueur. (ce n'est pas le cas de bindParam qui n'accepte qu'une variable)