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