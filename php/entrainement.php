<style>
* { font-family : calibri;}
h1 {padding : 10px; color: white; background-color: darkslategray;}
</style>
<h1>Ecriture et affichage</h1>
<!-- Tout d'abord, il est possible d'�crire du php dans du html mais l'inverse n'est pas possible -->

<?php // balise php ouverture et fermeture ?>
<?php
// Instruction d'affichage
// variable : types / déclaration / affectation
// Concaténation
// Guillemets et quotes
// Constante
// Condition et opérateur de comparaison
// Fonction prédéfinie
// Fonction utilisateur
// boucle
// inclusion
// array
// Classes et objets

echo 'Bonjour';
// echo est une instruction permettant d'effectuer un affichage
echo '<br />'; // Il est possible de mettre du HTML
echo 'Bienvenue<br>'; // Si vous regardez le code source, il n'est pas possible voir le code php car déjà interprété depuis le serveur
print 'Print est une autre instruction d\'affichage similaire à echo<br>';

// Les commentaires en PHP
// Ceci est un commentaire sur une seule ligne
# Ceci est un commentaire sur une seule ligne
/*
Ceci est un commentaire
sur plusieurs 
lignes
*/

// Autre fonction d'affichage mais spécifique au développement print_r() & var_dump()

echo '<h1>Variables: types / déclaration / affectation </h1>';
// définition: une variable est un espace nommé nous permettant de conserver une valeur.

// déclaration d'une variable avec le signe $, une variable est sensible à la casse
// Caractères autorisés: de a à z, de 0 à 9 et le "_" /!\ une variable ne peut pas commencer par un chiffre

// Affectation d'une valeur avec le signe =
$a = 127;
echo gettype($a); // int, integer dans sa version intégrale
echo '<br>';

$b = 1.5; // es décimales en anglais sont avec un point et non une virgule
echo gettype($b);
echo '<br>';

$a = 'une chaine';
echo gettype($a); // string
echo'<br>';

$b = '127';
echo gettype($b); //String
echo '<br>';

$a = true; // ou TRUE // ou l'inverse false / FALSE
echo gettype($a); // bool
echo '<br>';

echo '<h1>Concaténation</h1>';
// en php nous utiliserons le . pour la concaténation que l'on peut traduire par "suivi de"
$x = "Bonjour";
$y = "tout le monde";
echo $x . ' ' . $y . '<br>'; // en PHP on concatène avec le "." plutôt que le +
// On peut également concaténer avec une ',' en revanche uniquement avec echo (erreur avec print)

echo '<h1>Concaténation lors de l\'affectation</h1>';
$prenom1 = "Bruno";
$prenom1 = "Claire";

echo $prenom1 . '<br>';

$prenom2 = "Bruno ";
$prenom2 .= "Claire"; // équivalent à écrire $prenom2 = $prenom2 . 'claire';
// Le .= permet de rajouter à l'existant sans l'écraser
echo $prenom2 . '<br>';

echo '<h1>Guillemets et Quotes</h1>';

$message = "Aujourd'hui";
// ou
$message = 'Aujourd\'hui';

// Concaténation : 
echo $message . ' il fait chaud !<br>'; // 1ere méthode à privilégier
echo "$message il fait chaud !<br>"; // Dans des guillements, les variables sont reconnues et donc interprétées
echo '$message il fait chaud !<br>'; // Dans des quotes, les variables ne sont pas reconnues et interprétées comme du texte

echo '<h1>Les constantes et constantes magiques</h1>';
// Une cnstante est un peu comme une variable un espace nommé nous permettant de conserver une valeur sauf comme son nom l'indique, cette valeur ne pourra pas changer durant l'execution du script.

define("CAPITALE", "Paris"); // 1er argument: le nom de la constante / 2eme argument: sa valeur.
// Par convention, une constante s'écrit toujours en MAJUSCULE.
echo CAPITALE . '<br>';

// Constante magique
echo __FILE__ . '<br>'; // Affiche le chemin complet jusqu'à ce fichier
echo __LINE__ . '<br>'; // affiche le numéro de ligne du code

echo '<h1>Exercice</h1>';
// Mettre les valeurs lundi mardi mercredi dans 3 vaiables

$jour1 = 'Lundi';
$jour2 = "Mardi";
$jour3 = "Mercredi";
echo $jour1 . ' - ' . $jour2 . ' - ' . $jour3 . '<br>';

echo '<h1>Opérateurs arithmétiques</h1>';
$a = 10; $b = 2;
echo $a + $b . '<br>'; // Affiche 12
echo $a - $b . '<br>'; // Affiche 8
echo $a * $b . '<br>'; // Affiche 20
echo $a / $b . '<br>'; // Affiche 5
echo $a % $b . '<br>'; // Affiche 0

// Facilité d'écriture
echo $a += $b . '<br>'; // Equivaut à $a = $a +$b;
// $a -= $b;
// $a *= $b;
// $a /= $b;

echo '<h1>Structures conditionnelles (if / elseif / else) et opérateurs nde comparaison</h1>';
// isset - empty
// isset vérifie si une variable ou une donnée, l'élément, existe (s'il a été déclaré au préalable dans notre script par exemple). Il renvoie true ou false

// empty vérifie si la donnée ou la variable est vide ou non définie (empty vérifie au préalable si l'élément est défini avant de tester s'il est vide), il renvoie également true ou false
$var1 = 0; // ou $var1 = ""; ou $var1 = false;

if (empty($var1)) 
{
    echo 'la variable $var1 est vide ou non définie<br>';
}

$var2 = "";
if(isset($var2)) 
{
    echo "La variable var2 existe !<br>";
}
// Sur un if ou sur une boucle, s'il n'y a qu'une instruction, on peut ôter les accolades
// if (isset($var2))

// Opérateurs de comparaison
$a = 10; $b = 5; $c = 2;
if($a > $b) // Si $a est strictement supérieur à $b 
{
    print "'a' est bien supérieur à 'b'<br>"; 
}
else 
{
    print "'a' n'est pas supérieur à 'b'<br>";
}

// ET 
if($a > $b && $b > $c) // Si 'a' est supérieur à 'b' et dans le même temps si 'b' est supérieur à 'c' 
{
    echo 'Ok pour les deux conditions<br>';
}

// OU
if($a == 9 || $b > $c) // Si 'a' est égal à 9 OU si 'b' est supérieur à 'c'
{
    echo 'Ok pour au moins une des deux conditions<br>'; 
}

// XOR
if($a == 10 XOR $b < $c) // Avec XOR on ne rentre dans la condition que si l'une des deux conditions est vrai, si les deux sont vraies, on ne rentre pas.
{
    echo 'Ok pour une seule des deux conditions<br>';
}
// Avec XOR:
// true XOR true => false
// false XOR false => false
// true XOR false => true
// false XOR true => true
if($a == 8)
{
    print 'réponse 1<br>';
}
elseif ($a != 10)
{
    print 'réponse 2<br>';
}
else 
{
    echo 'réponse 3<br>';
}

$a1 = 1;
$a2 = "1";

if ($a1 == $a2)
{
    echo 'C\'est la même chose<br>';
}

if ($a1 === $a2)
{
    echo 'C\'est la même chose<br>';
}

/*
    = Affectation
    == Comparaison des valeurs
    === Comparaison des valeurs et du type
    != Différent de (en terme de valeur)
    !== Différent de (en terme de valeur ou de type)
    > Strictement supérieur
    < Strictement inférieur
    >= Supérieur ou égal
    <= Inférieur ou égal
*/

// Forme contractée des if: autre écriture
echo ($a == 10) ? 'if forme contractée<br>' : 'else en forme contractée<br>';
// Le ? représente le if 
// Les : représentent le else

echo '<h1>Condition switch</h1>';
// Les cases représentent des cas différents dans lesquels nous pouvons potentiellement rentrer.
$couleur = 'jaune';
switch($couleur)
{
    case 'bleu':
        echo 'Vous aimez le bleu<br>';
    break;
    case 'jaune':
        echo 'Vous aimez le jaune<br>';
    break;
    case 'rouge':
        echo 'Vous aimez le rouge<br>';
    break;
    case 'vert':
        echo 'Vous aimez le vert<br>';
    break;
    case 'rose':
        echo 'Vous aimez le rose<br>';
    break;
    default; // Toutes les autres possibilités
        echo 'Vous n\'aimez ni le bleu, ni le rouge, ni le vert<br>';
    break;
}

// Exercice

if ($couleur === 'bleu')
{
    echo 'Vous aimez le bleu<br>';
}
elseif ($couleur === 'jaune')
{
    echo 'Vous aimez le jaune<br>';
}
elseif ($couleur === 'rouge')
{
    echo 'Vous aimez le rouge<br>';
}
elseif ($couleur === 'vert')
{
    echo 'Vous aimez le vert<br>';
}
else 
{
    echo 'Vous n\'aimez ni le bleu, ni le rouge, ni le vert<br>';
}

echo '<h1>Les fonctions prédéfinies</h1>';
// Une fonction prédéfinie est déjà inscrite dans le langage, le développeur ne fait que l'exécuter.

echo 'Date du jour:<br>';
echo date("d/m/Y H:i:s");
// date() est une fonction prédéfinie permettant d'afficher la date. 
// En argument cette fonction accepte une chaîne de caractères.
// Selon les caractères fournis, cette fonction nous renvoie différents formats de date
// Voir la doc pour les formats disponibles

echo '<hr>' . time() .'<hr>';
// time() nous affiche le timestamp (nb de secondes écoulées depuis le 1er 1970)

// Traitement des chaînes (iconv_strlen() / strpos() / substr())
$email = 'jordanmuller29@gmail.com';
echo strpos($email, '@') . '<br>';
// strpos() permet de chercher dans une chaîne de caractères définie en premier argument un ou plusieurs caractères définis en second argument
// Ou on cherche puis qu'est-ce qu'on cherche
//  /!\ Dans une chaîne le premier caractère à la position 0

// Valeur de retour 
    // Success => On obtient un int (la position)
    // Echec => booleen false

$email2 = "ekrelnvfdo,fdo";
echo strpos($email2, "@") . '<br>';
var_dump(strpos($email2, "@")); echo '<br>'; // En cas d'échec, il nous renvoie un booléen false
// var_dump est une instruction d'affichage améliorée qui affiche la valeur de ce que l'on teste, plus son type, et si le type est string on obtient également sa longueur
// Ici var_dump() nous permet de voir le false obtenu via la fonction strpos()

// iconv_strlen
$phrase = 'um dolor sit amet, consectetur adipiscing elit. Duis ultrices orci eu sapien varius, id interdum quam tincidunt. Ut vitae interdum mauris. Morbi e';
echo iconv_strlen($phrase) . '<br>';
// iconv_strlen permet de compter le nombre de caractères dans une chaîne
// Success => int (longueur de la chaîne)

// substr()
$texte = "Donec sollicitudin dictum ligula, sit amet accumsan sapien imperdiet eu. Nam quis auctor orci. Nulla condimentum ut leo non malesuada. Nulla facilisi. Proin lacinia commodo efficitur. Aliquam gravida ac ligula quis suscipit. Mauris malesuada condimentum ligula sit amet tempor. Vivamus vel dictum e";
echo substr($texte, 0, 30) . " ...<a href ='#'>Lire la suite</a>"; 
// substr permet de découper une chaîne
    // 1er argument => la chaîne à découper
    // 2eme argument => la position de départ
    // 3eme argument => le nombre de caractères à renvoyer. (Cet argument est facultatif, s'il n'est pas présent on récupère tout depuis la position de départ)

echo '<h1>Les fonctions utilisateurs</h1>';
// Non inscrite au langage, c'est le développeur qui les déclare puis les exécute.

function separation() 
{
    echo '<hr><hr><hr>';
} 
// execution
separation(); // pas besoin d'écho, il est déjà dans la fonction

// fonction avec 1 argument
function bonjour($prenom)
{
    return 'Bonjour ' . $prenom . '<br>';
}

// execution
// un return nous renvoie le résultat de cette fonction en revanche si l'on veut faire un affichage il faudra passer par un echo
echo bonjour('Jordan');
$prenom = 'Marie';
echo bonjour($prenom);

// fonction pour aplliquer la tva
function applique_tva($nombre)
{
    return $nombre * 1.2;
}
echo applique_tva(1000) . '<br>';

// Exercice refaire la fonction précédente en donnant la possibilité à l'utilisateur de choisir le taux


function calcul_tva($nombre, $taux = 1.2) // Avec un argument initialisé par défaut, il devient facultatif. Si je ne fournis qu'un seul argument, alors $taux a par défaut la valeur 1.2
{
    return $nombre * $taux;
}
echo calcul_tva(1000, 1.5) . '<br>';
echo calcul_tva(1000) . '<br>';

// Environnement global & local
// global => le script complet
// local => à l'intérieur de la fonction

function jour_semaine()
{
    $jour = 'lundi';
    return $jour;
}
//echo $jour - $jour n'est pas définie dnas l'espace golbal => erreur
echo jour_semaine() . '<br>';
$jour2 = 'mardi';
echo $jour2 . '<br>'; 

// global vers local
$pays = 'France';

affichage_pays(); // Il est possible d'exécuter une fonction avant sa déclaration car l'interpréteur php charge toutes les fonctions du script avant d'exécuter le script
// Cela ne fonctionne pas avec les variables

function affichage_pays()
{
    global $pays; // Grâce au mot-clé global, il est possible de récupérer une variable depuis l'espace global sinon ce n'est pas possible car nous sommes dans un espace local, une fonction.
    echo 'Le pays est ' . $pays . '<br>';
}

// Affichage météo
function affichage_meteo($saison, $temperature = 0) 
{
    
    return "Nous sommes en " . $saison . " et il fait " . $temperature . " degré(s)<br>";
    echo 'Nous sommes mardi<br>'; // Cette ligne ne sera pas exécutée, lorsque l'on fait un return, on sort obligatoirement de la fonction et le code après le return n'est pas exécuté.
    //  On peut avoir plusieurs return uniquement dans des conditions (if / elseif/ else).
}
echo affichage_meteo('été', 34);
echo affichage_meteo('hiver', -1);
echo affichage_meteo('printemps', 10);

echo '<hr><hr>';

function affichage_meteo2($saison, $temperature)
{
    if ($temperature === 1 || $temperature === 0 || $temperature === -1)
    { 
        if ($saison === "printemps")
        {
            return "Nous sommes au " . $saison . " et il fait " . $temperature . " degré.<br>";
        }
        else {
            return "Nous sommes en " . $saison . " et il fait " . $temperature . " degré.<br>";
        }
    } else {
        if ($saison === "printemps")
        {
            return "Nous sommes au " . $saison . " et il fait " . $temperature . " degrés.<br>";
        }
        else {
            return "Nous sommes en " . $saison . " et il fait " . $temperature . " degrés.<br>";
        }
    }    
}

function affichage_meteo3($saison, $temperature)
{
    if (($temperature <= 1 && $temperature >= -1) && ($saison === "printemps"))
    {  
        return "Nous sommes au " . $saison . " et il fait " . $temperature . " degré.<br>";
    }   
    elseif (($temperature <= 1 && $temperature >= -1) && ($saison !== "printemps")) 
    {
        return "Nous sommes en " . $saison . " et il fait " . $temperature . " degré.<br>";
    }
    elseif (($temperature <= 1 && $temperature >= -1) && ($saison === "printemps")) 
    {
        return "Nous sommes au " . $saison . " et il fait " . $temperature . " degrés.<br>";
    }
    elseif (($temperature <= 1 && $temperature >= -1) && ($saison !== "printemps")) 
    {
        return "Nous sommes en " . $saison . " et il fait " . $temperature . " degrés.<br>";
    }    
}

function meteo($saison, $temperature) 
{
    $en = 'en';
    $s = 's';
    if ($saison == 'printemps')
    {
        $en = 'au';
    }
    if ($temperature > -2 && $temperature < 2)
    {
        $s = '';
    }
    return "Nous sommes " . $en . " " . $saison . " et il fait " . $temperature . " degré" . $s . ".<br>"; // On privilégie un seul return par fonction si c'est possible pour éviter la répétition de code
}

echo affichage_meteo3('été', 34);
echo affichage_meteo3('hiver', -1);
echo affichage_meteo3('hiver', 0);
echo affichage_meteo3('printemps', 10);

echo '<hr><hr>';

echo meteo('été', 34);
echo meteo('hiver', -1);
echo meteo('hiver', 0);
echo meteo('printemps', 10);

echo '<h1>Structure itérative: les boucles</h1>';

$i = 0; // valeur de départ
while ($i < 10) // condition d'entrée
{
    echo $i . ' - ';
    $i++; // Incrémentation ou décrémentation équivaut à écrire $i = $i + 1;
}
echo '<br>';
$j = 0; // valeur de départ
while ($j < 10) // condition d'entrée
{
    echo $j . ' - ';
    $j++; // Incrémentation ou décrémentation équivaut à écrire $j = $j + 1;
    if ($j === 9)
    {
        echo $j . '<br>';
        $j++;
    }
}

$y = 0;
while ($y < 10)
{
    if ($y === 9)
    {
        echo $y . '<br>';
    }
    else {
        echo $y . ' - ';
    }
    $y++; // Privilégier l'incrémentation hors condition
}

// Boucle for
// for (valeur de départ; condition_d_entree; incrementation)

// Exercice
// Afficher en utilisant while ou for un tableau HTML contenant 10 cellules
// Pour aller plus loin faire un tableau de 0 à 99 avec 10 cellules x 10 lignes
?>
<table style="border-collapse: collapse;" border = "1">  
    <tr>
<?php
for ($i = 0; $i < 10; $i++)
{
    echo '<td>' . $i . '</td>';
}
?>
    </tr>
</table>
<br>

<table style="border-collapse: collapse;" border = "1">  
    
<?php
$chiffre = 0;
for ($i = 0; $i < 10; $i++)
{
     ?>
     <tr>
     <?php    
    for ($j = 0; $j < 10; $j++)
    {
        echo '<td>' . $chiffre . '</td>';
        $chiffre++;
    }
    ?>      
    </tr>
    <?php
}
?>
</table>
<br>
<table style="border-collapse: collapse;" border = "1"> 
     
<?php
for ($i = 0; $i < 100; $i++)
{
    if ($i%10 == 0)
    {
        echo '<tr><td>' . $i . '</td>';
    }
    else {
         echo '<td>' . $i . '</td>';
    }
}
?>
    </tr>
</table>
<br>
<?php
// Correction
echo '<table style="border-collapse: collapse; width 100%;" border = "1"><tr>';

for ($i = 0; $i < 10; $i++)
{
    echo '<td>' . $i . '</td>';
}

echo '</tr></table>';

echo '<hr><hr>';

echo '<table style="border-collapse: collapse; width 100%; text-align: center; color: red;" border = "1">';

for ($j = 0; $j < 10; $j++)
{
    echo '<tr>'; 
    for ($i = 0; $i < 10; $i++)
    {
        echo '<td>' . ($i + $j * 10) . '</td>'; // On peut aussi concaténer en écrivant echo '<td>' . $i . $j . '</td>';
    }
    echo '</tr>';
}
echo '</table>';

echo '<h1>Les inclusions de fichier</h1>';
// Créer un fichier dans le même dossier que celui-ci: exemple.inc.php
// Dans ce fichier mettez du texte. (lorem)

echo '<b>Première fois avec include:</b><br>';
include("exemple.inc.php");

// Les chemins
// "exemple.inc.php" est un chemin relatif qui part du fichier entrainement.php
// "../exemple.inc.php" est un chemin parent depuis le fichier entrainement.php
// "/.../exemple.inc.php" est un chemin absolu qui part du serveur xampp ou celui utilisé (du htdocs)

echo '<hr><b>Deuxième fois avec include_once:</b><br>'; // Le once vérifie si le fichier a déjà été appelé, si c'est le cas il ne l'affiche pas de nouveau
include_once("exemple.inc.php");

echo '<b>Première fois avec require:</b><br>';
require("exemple.inc.php");

echo '<hr><b>Deuxième fois avec require_once:</b><br>';
require_once("exemple.inc.php");

// Dans un fhier include() ou require(), on est dans une fonction, donc dans un espace global, il faut repasser les variables en global pour les utiliser
// En cas d'erreur, include() affiche un avertissement et continue le traitement, require() stoppe l'exécution

echo '<h1>Les tableaux ARRAY</h1>';
// Un tableau array est déclaré un peu comme une variable sauf qu'au lieu de ne conserver qu'une seule et unique valeur, dans un tableau nous allons avoir un ensemble de valeurs.

// Déclaration d'un tableau
$tableau = array("lundi", "mardi", "mercredi", "jeudi", "vendredi", "samedi", "dimanche");

// Outil pour voir le contenu d'un tableau
echo '<b>Affichage du tableau avec print_r:</b><br>';
echo '<pre>'; print_r($tableau); echo '</pre>';

echo '<b>Affichage du tableau avec var_dump:</b><br>'; // Privilégier le var_dump() au print_r(), print_r() juste pour afficher le contenu d'une variable
echo '<pre>'; var_dump($tableau); echo '</pre>';

// Autre façon de déclarer un tableau array
$tab = array(); // Cette ligne est facultative
$tab[] = "France"; // On écrire comme celà directement
$tab[] = "Italie"; 
$tab[] = "Espagne"; 
$tab[] = "Angleterre"; 
$tab[] = "Portugal"; 
$tab[] = "Belgique"; 
$tab[] = "Hollande"; 

echo '<pre>'; var_dump($tab); echo '</pre>';

echo $tab[2] . '<br>'; // Pour extraire un élément, on passe par l'indice correspondant
// Dans le doute faire une vérif avec var_dump

echo '<hr>';

// Boucle foreach pour les tableaux de données ARRAY ou Object
foreach($tab AS $valeur)
{
    // foreach est un outil pour faire une boucle spécifique aux tableaux array et object
    // Cette boucle est dynamique et tournera autant de fois qu'il y a d'éléments dans notre tableau
    // Le mot clé AS est obligatoire et permet de donner un alias via une variable qui représentera à chaque tour de boucle la valeur en cours
    echo $valeur . '<br>';
}

echo '<hr>';
// Pour récupérer également l'indice en cours, il nous suffit de rajouter une variable de réception après le mot clé AS
foreach($tab AS $ind => $val)
{
    echo $ind . ' - ' . $val . '<br>';
}

// Il est possible de choisir nous-mêmes les indices
$plats = array('un' => 'Pâtes', 'deux' => 'Crêpes', 'trois' => 'Salade de fruits', 77 => 'Eau');
echo '<pre>'; var_dump($plats); echo '</pre>';

$couleurs['j'] = 'jaune';
$couleurs['b'] = 'bleu';
$couleurs['bl'] = 'blanc';
$couleurs['m'] = 'marron';
$couleurs['v'] = 'vert';
$couleurs['r'] = 'rouge';

echo '<pre>'; var_dump($couleurs); echo '</pre>';

echo $couleurs['b'] . '<br>';

// Pour connaître la taille d'un tableau (nombre d'élements dans le tableau array)
echo 'Taille du tableau $couleurs: ' . count($couleurs) . '<br />';
echo 'Taille du tableau $couleurs: ' . sizeof($couleurs) . '<br />';

// count() et sizeof() font la même chose

echo '<h1>Tableau array multidimensionnel</h1>';
// Nous parlons de tableaux array multidimensionnels lorsqu'un tableau est lui même contenu dans un autre tableau.

$tableau_etudiants = array( 
    0 => array('pseudo' => 'Marie', 'Nom' => 'Durand', 'email' => 'marie@email.fr'), 
    1 => array('pseudo' => 'Luc', 'Nom' => 'Dupond', 'email' => 'luc@email.fr'), 
    2 => array('pseudo' => 'Jean', 'Nom' => 'Soleil', 'email' => 'jean@email.fr'), // Pour les tableaux array, on peut laisser une virgule après la dernière valeur pour anticiper les prochains ajouts
    );

echo '<pre>'; print_r($tableau_etudiants); echo '</pre>';
echo $tableau_etudiants[1]['email'] . '<br /><hr />'; // Nous rentrons d'abord l'indice 1 du premier niveau puis à l'indice 'email' du deuxième niveau

$taille_tableau = count($tableau_etudiants);

for($i = 0; $i < $taille_tableau; $i++)
{
    // Afficher les emails du deuxième niveau de ce tableau
    echo $tableau_etudiants[$i]['email'] . '<br />';
}
echo '<hr />';
// Avec un foreach
foreach($tableau_etudiants AS $valeur)
{
    echo $valeur['email'] . '<br />';
}

echo '<hr><hr>';

// On affiche tous les éléments du tableau
foreach($tableau_etudiants AS $data)
{
    foreach($data AS $donnees)
    {
        echo $donnees . '<br />';
    }
    echo '<hr />';
}

echo '<h1>Les Objets</h1>';
// Un objet est un autre type de données. Un peu à la manière d'un array, il permet de conserver des valeurs mais cela va plus loin puisqu'on peut également avoir des fonctions dans un objet.
// L'objet est une variante d'une variable, c'est un espace-mémoire permettant de conserver des infos et d'appliquer des comportements
// Une information dans un objet s'appelle une propriété ou attribut
// Une fonction dans un objet s'appelle une méthode

// Un objet est toujours issu d'une classe (som modèle de construction).

// Pour déclarer une classe, on met une majuscule par convention
class Etudiant 
{
    public $prenom = 'Marie'; // $prenom est une propriété
    // public est un mot-clé permettant de préciser que l'élément sera accessible directement sur l'objet. Sinon il faudrait passer par des méthodes permettant de récupérer cette information ou de la modifier (Il existe aussi protected / private / static)
    public $age = 25;
    public function pays()
    {
        return 'France';
    }
}

// Un objet est un conteneur symbolique qui possède sa propre existence et incorpore des informations(propriétés) et des fonctions(méthodes)

// Pour instancier un objet:
$mon_objet_1 = new Etudiant(); // new est un mot clé obligatoire permettant d'instancier un objet depuis une classe
$mon_objet_2 = new Etudiant(); // new est un mot clé obligatoire permettant d'instancier un objet depuis une classe

echo '<pre>'; var_dump($mon_objet_1); echo '</pre>';
echo '<pre>'; var_dump($mon_objet_2); echo '</pre>';

// Pour voir les méthodes de l'objet avec la fonction get_class_methods()
echo '<pre>'; var_dump(get_class_methods($mon_objet_1)); echo '</pre>';

// Pour récupérer une propriété de l'objet
echo $mon_objet_1->prenom . '<br />'; //Lorsqu'on appelle une propriété avec une flèche simple, on n'écrit le nom de la propriété dans "$"
// Pour les tableaux, on utilise la double flèche =>

// Pour récupérer une méthode de l'objet
echo $mon_objet_1->pays() . '<br />';

// On peut appeler ou modifier directement la propriété $prenom comme elle est publique 
echo $mon_objet_1->prenom = "Jordan";

// Dans l'absolu, la programmation objet permet de mieux organiser notre code, surtout pour le codeage en équipe