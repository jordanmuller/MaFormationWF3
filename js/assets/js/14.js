//  LES EVENEMENTS

/*
Les événements vont me permettre de déclencher une fonction, c'est à dire une série d'instruction suite à une action de mon utilisateur

Objectif : être en mesure de capturer ces événements afin d'exécuter une fonction.

Les évènements : MOUSE (souris)

    click : au clic sur un élément,
    mouseenter : la souris passe au dessus de la zone qu'occupe un élément
    mouseleave : la souris sort de cette zone

Les évènements : KEYBOARD (clavier)

    keydown : une touche du clavier est enfoncée
    keyup   : une touche a été relachée

Les évènements : WINDOW (fenêtre)

    scroll : défilement de la fenêtre
    resize : redimensionnement de la fenetre

Les évènements : FORM (formulaire)

    change : pour les éléments <input>, <select> et <textarea>
    submit : à l'envoi (soumission) d'un formulaire

Les évènements : DOCUMENT

    DOMContentLoaded : Executer lorsque le document HTML est complètement chargé sans attendre le CSS et les images                  

*/

//  LES ECOUTEURS D'EVENEMENTS

/*
Pour attacher un évènement à un élément, ou autrement dit, pour déclarer un écouteur d'évènement qui se chargera de lancer une action, soit une fonction pour un évènement donné, je vais utiliser la syntraxe suivante :

*/

var p = document.getElementById("monParagraphe");

// -- Je souhaite que mon paragraphe soit rouge au clic de la souris

    // -- 1 Je définis une fonction chargée d'executer cette action.
    function changeColorToRed() {
        p.style.color = "red";
    }

    //  -- 2 Je déclare un écouteur qui se chargera d'appeler la fonction au déclenchement de l'évènement
    p.addEventListener("click", changeColorToRed);

    //  Exercice créez un champ "input" type text avec un id unique affichez dans une alerte la saisie de l'utilisateur

    var input = document.createElement("input");
    // On définit les attributs de l'input
    input.setAttribute("type", "text");
    input.setAttribute("placeholder", "Saisissez un contenu...");
    //  On définit son ID
    input.id = "monInput";
    document.body.appendChild(input);

    function affichage () {
        alert(input.value);
    }
// Création d'un écouteur d'évènement
//  Ce n'est pas nous qui executons la fonction, donc affichage sans "()", c'est l'addEevenListener qui m'execute tout seul
    input.addEventListener("change", affichage);
