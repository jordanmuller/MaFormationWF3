//  Réaliser une fonction permettant à un internaute :
/*  -saisir son prénom dans un prompt
    -retourner à l'utilisateur : Bonjour, quel age as-tu ?
    -saisir son âge
    -tu es donc né en année de naissance
    -afficher un récapitulatif
*/
function utilisateur() {
    var prenom = String(prompt("Quel est ton prénom ?"));
    document.write("Bonjour " + prenom + ", quel âge as-tu ?<br>");
    var age = Number(prompt("Entre ici ton age :"));
    var date = new Date();
    var naissance = date.getFullYear() - age;
    document.write("Tu es donc né en " + naissance + ".<br>");
    document.write("Bonjour " + prenom + ", tu as " + age + " ans !<br>");
}
utilisateur();

// // 1 -- Initialisation des variables
// var anneeActuelle = new Date();

// // 2 -- Création de ma fonction
// function hello() { 
//     // 2a Je demande à l'utilisateur son prénom
//     let prenom = prompt("Hello ! What is your name ?","<Saisir votre prénom :>");
//     console.log(prenom);
//     console.log(typeof prenom);
//     // 2b Je lui demande son âge
//     let age = parseInt(prompt("Hello ! " + prenom + " How old are you ?","<Saisir votre âge :>"));
//     console.log(age);
//     console.log(typeof age);
//     // 2c J'affiche une alert avec son année de naissance
//     alert("AMAZING ! So you were born in " + (anneeActuelle.getFullYear() - age) + "!");
//     // 2d Affichage dans ma page HTML
//     document.write("Hello " + prenom + " it's AMAZING ! You're " + age + " years old !");
// }
// // 3 -- Execution de ma fonction
// hello();
