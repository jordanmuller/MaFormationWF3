//  -- Déclarer un tableau numérique
var monTableau = [];
var myArray    = new Array;

// -- Affecter des valeurs à un tableau numérique
monTableau[0] = "Jordan";
monTableau[1] = "Tanguy";
monTableau[2] = "Géraldine";

// -- Afficher le contenu de mon tableau numérique dans la console

console.log(monTableau[0]);
console.log(monTableau[2]);
console.log(monTableau); // Affiche toutes les données.

// -- Déclarer et affecter des valeurs à un tableau numérique
var nosPrenoms = ["Hugo", "Tanguy", "Géraldine", "Tristan", "Christian"];
console.log(nosPrenoms);
console.log(typeof nosPrenoms);
console.log(nosPrenoms.length);

// -- Déclarer et affecter des valeurs à un Objet. (Pas de Tableaux Associatifs en JS)

var Coordonnee = {
    "prenom": "Hugo",
    "nom": "LIEGEARD",
    "age": 27
}

console.log(Coordonnee);
console.log(typeof Coordonnee);
console.log(Coordonnee.length); // Un objet n'a pas de longueur

// -- Comment créer et affecter des valeurs à un tableau 2 Dimensions
// Façon non efficace pour comprendre

//  -- Je vais créer 2 Tableaux numériques
var listeDePrenoms = ["Hugo", "Tanguy", "Géraldine"];
var listeDeNoms = ["LIEGEARD", "MANAS", "SOUKAI"];

// -- Je vais créer un tableau 2 dimensions à partir de mes 2 tableaux précédents

var Annuaire = [listeDePrenoms, listeDeNoms];
console.log(Annuaire);

// Afficher un Nom et un Prénom sur ma page HTML avec document.write()

// document.write(Annuaire[0][1]); // 1er tableau 2eme élément
// document.write(" ");
// document.write(Annuaire[1][1]); // 2eme tableau 2eme élément

var listePrenoms = ["Tanguy", "Jordan", "Alex", "Géraldine", "Tristan"];
var listeNoms = ["MANAS", "SAKAI", "LIEGEARD", "MULLER", "LOUET"];
var listeTel = ["06-88-77-99-22", "06-88-77-99-21", "06-88-77-99-20", "06-88-77-99-19", "06-88-77-99-23"];
var Person = ["Tanguy MANAS", "Jordan MULLER", "Alex LIEGEARD", "Géraldine MACHIN", "Tristan TRUC"]

var annuaireDesStagiaires = [listePrenoms, listeNoms, listeTel];
// document.write(annuaireDesStagiaires[0][1]);
// document.write(" ");
// document.write(annuaireDesStagiaires[1][1]);
// document.write(" ");
// document.write(annuaireDesStagiaires[2][1]);
var annuaireDeux = [Person, listeTel];

// document.write(annuaireDeux[0][1]); 
// document.write(" ");
// document.write(annuaireDeux[1][1]); 

// Tableau écrit sous format JSON 
var AnnuaireDesStagiaires = [
    {"prenom": "Hugo", "nom": "LIEGEARD", "tel": "07 83 97 15 15"},
    {"prenom": "Tanguy", "nom": "MANAS", "tel": "XX XX XX XX XX"},
    {"prenom": "Yimin", "nom": "JI", "tel": "XX XX XX XX XX"}
];

console.log(AnnuaireDesStagiaires);
console.log(AnnuaireDesStagiaires[0]["nom"]); 
console.log(AnnuaireDesStagiaires[1].nom);  // Mieux l'usage du point

//  Ajouter un élément dans un tableau

var Couleurs = ["rouge", "jaune", "vert"];

// Si je souhaite ajouter un élément dans mon tableau
// -- Je fais appel à la foncion push() qui renvoie aussi le nombre d'éléments de mon tableau

var nombreElementsDeMonTableau = Couleurs.push('orange');
console.log(Couleurs);
console.log(nombreElementsDeMonTableau); // Ce n'est pas un tableau, c'est le nombre d'éléments renvoyés par push

//  -- NB : La fonction unshift() permet d'ajouter un ou plusieurs éléments en début de tableau

// Recupérer et sortir le dernier élément

// -- La fonction pop() me permet de supprimer le dernier élément de mon tableau et d'en récupérer la valeur 
// Je peux accessoirement cette valeur dans une variable.

var monDernierElement = Couleurs.pop();
console.log(monDernierElement);

// La même chose est possible avec le premier élément en utilisant la fonction shift();

// NB La fonction splice() permet de faire sortir un ou plusieurs éléments de votre tableau, il prend deux valeurs, l'indice dé l'élément sélectionné et le nombre d'élément supprimé.