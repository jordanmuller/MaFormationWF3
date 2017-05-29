// La concaténation

var debutDePhrase = "Aujourd'hui ";
var dateDuJour = new Date();
var suiteDePhrase = ", sont présents: ";
var nombreDeStagiaires = 19;
var finDePhrase = " stagiaires.<br />";

// Nous souhaitons maintenant grâce à la concaténation afficher tout ce petit monde, 

document.write(debutDePhrase + dateDuJour.getDate() + "/" + (dateDuJour.getMonth() + 1) + "/" + dateDuJour.getFullYear() + suiteDePhrase + nombreDeStagiaires + finDePhrase);

// Créer une concaténation à partir des éléments suivants

var phrase1 = "Je m'appelle ";
var phrase2 = "Jordan et j'ai ";
var age     = 25;
var phrase3 = " ans !<br>";

document.write(phrase1 + phrase2 + age + phrase3);