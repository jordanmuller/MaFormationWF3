// LE CHAINAGE DE METHODES EN JQUERY

$(function() {
    // -- Je souhaite cacher toutes les div de ma page HTML
    $('div').hide('slow', function() {
        // Une fois que la méthode .hide est terminée, mon alert peut s'executer
        alert('Fin du Hide');
        // NOTA BENE La fonction s'executera pour l'ensemble des éléments du sélecteur, ici l'alert s'affiche deux fois car il y a deux div

        // -- CSS
        $('div').css("background", "yellow");
        $('div').css("color", "red");

        // -- Je fais réapparaître mes divs
        $('div').show();
    }); //fin fonction anonyme

    // En utilisant le chaînage de méthodes, vous pouvez faire s'enchaîner plusieurs fonctions les unes après les autres

    $('p').hide(1000).css('color', 'blue').css('font-size', '20px').delay(2000).show(500);

    // Mais, c'est encore trop long
    $('p').hide().css({'color':'blue','font-size':'20px'}).delay(2000).show(500);
});