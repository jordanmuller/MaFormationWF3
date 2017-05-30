// DISPONIBILITE DU DOM

/*
    A partir du moment où mon DOM (ensemble de l'arborescence de ma page est complètement chargé), je peux commencer à utiliser jQuery
    
    Je vais mettre l'ensemble de mon code dans une fonction, elle sera appelée automatiquement par jQuery lorsque le DOM sera entièrement défini.

    3 façons de faire :
*/

// -- 1ère possibilité
jQuery(document).ready(function() {
    // Ici, le DOM est entièrement chargé, je peux procéder à mon code JS.
});

// -- 2ème possibilité
$(document).ready(function () {

});

// -- 3ème possibilité, sans le (document).ready()
$(function() {
    alert("Hello World !");

    // en JS
    document.getElementById("texteEnJQuery").innerHTML = "<strong>Mon texte en JS</strong>"; // innerHTML permet d'interpréter les balises écrites dans le value

    // en jQuery (tous les sélecteurs sont les mêmes qu'en CSS)
    $("#texteEnJQuery").html("Mon texte en jQuery !");
});



