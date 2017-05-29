// Les conditions

var majoriteLegaleFR = 18;
if (majoriteLegaleFR >= 18) {
    alert("Bienvenu !");
} else {
    alert("Google...");
}

// Exercice
/*
Créer une fonction permettant de vérifier l'âge d'un visiteur, s'il a la majorité légale, alors je lui souhaite la bienvenue. Sinon, je fais une redirection sur Google après lui avoir signalé le souci.
*/
function verifAge () {
    var ageVisiteur = Number(prompt("Quel est votre âge :"));
    if (ageVisiteur >= majoriteLegaleFR) {
        alert("Bienvenu sur mon site !");
    } else {
        alert("Tu n'as pas l'âge légal pour ce site, retourne sur Google!");
        // Rediriger sur une page en JS avec document.location.href
        document.location.href="https://www.google.fr/";
    }
}
verifAge();

// 1 -- Déclarer la majorité légale
var majoriteLegaleFR = 18;
// 2 -- Céer une fonction pour demander son âge
function verifierAge() { 
    return parseInt(prompt("Bonjour, quel âge avez-vous ?","<Saisissez votre âge>"));
}
// 3 -- Une condition pour vérifier si l'âge de l'utilisateur est supérieur à la majoriteLegale.FR
// pas besoin d'appeler la fonction, elle s'exécute dans la condition de if
if (verifierAge() >= majoriteLegaleFR) { 
// 4 -- J'affiche un message de bienvenu
    alert("Bienvenu sur mon site Internet pour les majeurs...");
} else {     
// 5 -- J'affiche une alerte
alert("ATTENTION !!! Vous devez être majeur pour entrer sur ce site");
// 6 -- Je redirige vers Google
document.location.href = "http://lmgtfy.com/?q=majorit%C3%A9+en+france";
}


// LES OPERATEURS DE COMPARAISON

// L'opérateur de comparaison "==" signifie : Egal à...
// Il permet de vérifier que deux variables sont identiques

// L'opérateur de comparaison "===" signifie :  Strictement Egal à...
// Il permet de vérifier que deux variables sont identiques que ce soit pour sa valeur ou son type de données (typeof)

// -- L'opérateur de comparaison "!=" signifie : Différent de...

// -- L'opérateur de comparaison "!==" signifie : Strictement Différent de...

// Exercice

// -- BASE DE DONNEES
var email, mdp;
email ="wf3@hl-media.fr";
mdp = "wf3";
/*
var emailUtilisateur = prompt("Entrez votre adresse email");
var mdpUtilisateur   = prompt("Entrez votre mot de passe");
if (emailUtilisateur !== email) {
    alert("Erreur ! Votre adresse email est incorrect !");
} else if (mdpUtilisateur !== mdp) {
    alert("Erreur ! Votre mot de passe est incorrect");
} else {
    alert("Bienvenue sur le site Webforce 3 !");
}

if (emailUtilisateur === email) {
    if (mdpUtilisateur !== mdp) {
        alert("Erreur ! Votre mot de passe est incorrect");
    } else {
        alert("Bienvenu sur mon site");
    }
} else {
    alert("Erreur ! Votre adresse email est incorrecte");
}
*/

// 1 -- Demander son email à l'utilisateur avec un prompt
var emailLogin = prompt("Bonjour, quel est votre email ?","<Saisissez votre email>");


if(emailLogin === email) {
    //  2a Si tout est ok, je cntinue la vérification avec le mot de passe
    var mdpLogin = prompt("Votre mot de passe ?","<Saisissez votre mot de passe");
    if(mdpLogin === mdp) {
        alert("Bienvenue Utilisateur !");
    } else {
        alert("ATTENTION, votre mot de passe est incorrect");
    }
} else {
    // 2b Sinon, les emails ne correspondant pas, je lance une Alert...
    alert("ATTENTION, nous n'avons pas reconnu votre adresse amail");
}

//  Exemple avec les fonctions

function connexion (user, motdepasse) {
    if((user === email && motdepasse === mdp)) {
        return true;
    } else {
        return false;
    }
}
var emailLogin = prompt("Bonjour, quel est votre email ?","<Saisissez votre email>");
var mdpLogin = prompt("Votre mot de passe ?","<Saisissez votre mot de passe");
if(connexion(emailLogin, mdpLogin)) { // Le if vérifie si la condition est true
    alert("Bienvenue !");
} else {
    document.location.href = "http://www.google.fr";
}

// LES OPERATEURS LOGIQUES

// L'opérateur ET : && ou AND

// -- Si la combinaison emailLogin et email correspond ET la combinaison mdpLogin et mdp correspond.

// L'opératur OU : || ou OR

//  L'opérateur "!" : qui signifie le CONTRAIRE de, ou encore NOT