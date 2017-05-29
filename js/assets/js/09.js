// LES BOUCLES

// -- La boucle FOR

// -- Pour i = 1; tant que i <= (strictement inférieur ou égal) 10; alors j'incrémente i
for (var i= 1; i <= 10; i++) {
    document.write("<p>Instruction executée : <strong>" + i + "</strong></p>");
}

document.write("<hr>");

// -- La boucle WHILE: Tant que

var j = 1;
while (j <= 10) {
    document.write("<p>Instruction executée : <strong>" + j + "</strong></p>");
    j++; // NE PAS OUBLIER L INCREMENTATION DE J
}

document.write("<hr>");

// Exercice
// On récupère Hugo avec prenoms[0] c'est l'indice du tableau qui doit être modifiée à chaque tour dans la boucle
var prenoms = ["Hugo", "Jean", "Matthieu", "Luc", "Pierre", "Marc"];

for (var i = 0; i < prenoms.length; i++) {
    document.write("<p>" + prenoms[i] + "</p>");
}

document.write("<hr>");

var j = 0;
while (j < prenoms.length) {
    document.write("<p>" + prenoms[j] + "</p>");
    j++;
}

document.write("<hr>");

for (var i = (prenoms.length - 1); i >= 0; i--) {
    document.write("<p>" + prenoms[i] + "</p>");
}

document.write("<hr>");

var j = prenoms.length - 1;
while (j >= 0) {
    document.write("<p>" + prenoms[j] + "</p>");
    j--;
}

document.write("<hr>");

// Attention à la performance avec forEach
prenoms.forEach(affichePrenom);

function affichePrenom(prenom, index) {
    console.log(prenom);
}
