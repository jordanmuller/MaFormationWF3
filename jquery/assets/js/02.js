//  LES SELECTEURS JQUERY

// -- Format $(sélecteur)
// -- en jQuery, tous les sélecteurs CSS sont disponibles

$(function() {
    // Les flemmards.js
    function l(e) {
        console.log(e);
    }
    //  Sélectionner des balises SPAN :
        // En JS
        l("SPAN en JS :");
        l(document.getElementsByTagName("span"));

        // En jQuery
        l("Span en jQuery :");
        l($("span"));

    //  Sélectionner mon menu :
        // En JS
        l("ID en JS :");
        l(document.getElementById("menu"));

        // En jQuery
        l("ID en jQuery :");
        l($("#menu"));

    // Sélectionner par classe
        // En JS
        l("classe en JS :");
        l(document.getElementsByClassName("maClasse"));

        // En jQuery
        l("Classe en jQuery :");
        l($(".maClasse"));

    // Sélectionner par attribut
        // En jQuery
        l("Par attribut en jQuery :");
        l($("[href='http://www.google.fr']")); 
});