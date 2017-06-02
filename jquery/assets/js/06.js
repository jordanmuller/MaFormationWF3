// LES SELECTEURS D'ENFANTS JQUERY

// -- Initialisation de jQuery

$(function() {
    // Ici commence mon code jQuery
    // lesflemmards.js
    function l(e) {
        console.log(e);
    }
    // Je souhaite sélectionner toutes les sections
    l($('div'));

    // -- Je souhaite sélectionner mon header
    l($('header'));

    // -- Je souhaite tous les éléments descendants directs (enfants) qui sont dans mon header
    l($('header').children()); // Récupérer les enfants d'un parent

    // -- Je souhaite parmi mes descendants directs, uniquement les éléments "ul"
    l($('header').children('ul'));

    // --Je souhaite récupérer tous les éléments "li" de mon "ul"
    l($('header').children('ul').find('li')); // On aurait pu taper $('header').find('li'), .children() ne concerne que les enfants

    // -- Je souhaite récupérer uniquement le 2eme élément de mes "li"
    l($('header').find('li').eq(1));

    // -- Je souhaite connaître le voisin immédiat de mon "header"
    l($('header').next());
    l($('header').next().next()); // Le voisin du voisin
    l($('header').prev()); // Le voisin d'avant

    // -- LES PARENTS
    l($('header').parent()); // renvoie body, le parent de header
});