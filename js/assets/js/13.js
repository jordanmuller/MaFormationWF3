//  MANIPULATION DES CONTENUS

function l(e) {
    console.log(e);
}

// Je souhaite récupérer mon lien
var google = document.getElementById("google");
l(google);

//  Maintenant je souhaite récupérer des informations 

// A Le lien vers lequel pointe la balise
l("Le lien vers lequel pointe la balise :");
l(google.href);

// B L'ID de la balise
l("L'ID de la balise :");
l(google.id);

// C La Class de la balise !
l("La class de la balise :");
l(google.className);

// D Le texte de la balise (l'élément)
l("Le texte de la balise :");
l(google.textContent);

// Maintenant je souhaite modifier le contenu de mon lien
//  Comme une variable classique, je vais simplement affecter une nouvelle valeur
google.textContent = "Mon lien vers Google !";

// AJOUTER UN ELEMENT DANS MA PAGE

//  Nous allons utiliser deux méthodes :
    // -- 1 la fonction document.createElement() va permettre de générer un nouvel élément dans le DOM que je pourrai par la suite mmodifier avec les méthodes que nous venons de voir

    //  PS : ce nouvel élément est placé en mémoire

    //    Création de la balise span

    var span = document.createElement("span");
    span.id = "monSpan";
    span.textContent = "Mon beau texte en JS";

    // -- 2 La fonction appendChild() va me permettre de rajouter un enfant à un élément du DOM, ici à l'élément de l'ID google

    google.appendChild(span);
    // Création de la balise h1
    var h1 = document.createElement("h1");
    //  Création de la balise a
    var a = document.createElement("a");
    // Je donne un titre à mon lien
    a.textContent="Titre de mon article";
    //  Je donne un lien à mon lien
    a.href="#";
    //  Je mets mon lien dans mon h1
    h1.appendChild(a);
    // Je mets mon h1 dans ma page, dans mon body
    document.body.appendChild(h1);
    a.style.color = "red";
    a.style.textDecoration = "none"; 

