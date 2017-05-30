var BaseDeDonnees = [
{'prenom' : 'Hugo', 'nom' : 'LIEGEARD', 'email' : 'wf3@hl-media.fr', 'mdp' : 'wf3'},
{'prenom' : 'Rodrigue', 'nom' : 'NOUEL', 'email' : 'rodrigue@hl-media.fr', 'mdp' : 'wf3'},
{'prenom' : 'Nathanael', 'nom' : 'DORDONNE', 'email' : 'nathanael.d@hl-media.fr', 'mdp' : 'wf3'}
];

var mail     = prompt("Veuillez entrer votre email :");
var password = prompt("Veuillez entrer votre mot de passe :");
var loged    = false;
for ( var i = 0; i < BaseDeDonnees.length; i++) {
    var utilisateur = BaseDeDonnees[i];
    if(mail === utilisateur.email && password === utilisateur.mdp){
        document.write("Bonjour " + utilisateur.prenom + " " + utilisateur.nom)
        loged = true;
        break;
    }
}
if (loged === false) {
    alert("Vos identifiants sont incorrects");
}