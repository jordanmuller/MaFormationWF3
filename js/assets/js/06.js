// LES FONCTIONS

//  Déclarer une fonction
//  Cette fonction ne retourne aucune valeur
function ditBonjour() {
    // Lors de l'appel de la fonction les instructions seront exécutées
    alert("Bonjour !");        
}
// J'appelle la fonction "ditBonjour()" et je déclenche ses instructions, les "()" sont obligaoires car c'est une fonction et non une variable.
ditBonjour();

// -- Déclarer une fonction qui prend une variable en paramètres

function Bonjour(prenom, nom) {
    alert("Bonjour " + prenom + " " + nom + " !");
    document.write("<p>Hello <strong>" + prenom + " " + nom + "</strong> !</p>");
}
Bonjour("Jordan", "Muller"); // Les prénoms et les noms sont des strings

// -- Ou
//  Variables globales
var monPrenom = "Jordan";
var monNom    = "Muller";
// On utilise en paramètre les variables globales du document
Bonjour(monPrenom, monNom);

//  Exercice: Créer une fonction permettant d'effectuer l'addition de deux nombres passées en paramètres

function calculer(nombre1, nombre2) {
    // var resultat = nombre1 + nombre2
    // return resultat;
    // Le mot-clé return permet de renvoyer une valeur en sortie.
    return  nombre1 + nombre2;
}
console.log(calculer(5, 12));