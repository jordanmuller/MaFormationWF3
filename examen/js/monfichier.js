// -- Initialisation de jQuery
$(function() {

    $("#formulaire").on('submit', function(event) {
        //Arrêt de la redirection du formulaire
        event.preventDefault();
        
        // -- Suppression des différentes erreurs
        // -- Je supprime la classe has-error en ciblant les élément qui possèdent cette classe. 
       

        // Déclaration des variables
        var selection = $('#selection')
        var saisie    = $('#message');
       console.log(saisie.val().length);

        // Vérification de la sélection d'un chat
        if (selection.val() === null) {
            selection.parent().addClass('has-error');
            $("<p class='text-danger'>N'oubliez pas de sélectionner le nom d'un chat</p>").appendTo(selection.parent());
        } 

        //  Vérification du message de saisie
        if (saisie.val().length < 15) {
            saisie.parent().addClass('has-error');
             $("<p class='text-danger'>Votre message doit contenir au minimum 15 caractères </p>").appendTo(saisie.parent());
        }
        
        if ($(this).find('.has-error').length > 0) {
            selection.change(function() {
                selection.parent().removeClass('has-error');
                selection.parent().remove('<p>');
                $("#formulaire .alert-danger").remove();
            })
            $('#message').change(function () {
                message.parent().removeClass('has-error');
                $("#message .text-danger").remove();
                $("#formulaire .alert-danger").remove();
            }) 
        }
        

        if ($(this).find('.has-error').length == 0) {
            $(this).replaceWith('<div class="alert alert-success">Votre demande a bien été envoyée ! Nous vous répondrons dans les meilleurs délais.</div>');
        }   else {
            $(this).prepend('<div class="alert alert-danger">Nous n\'avons pas été en mesure de traiter votre demande.</div>')
        }   
    })
})