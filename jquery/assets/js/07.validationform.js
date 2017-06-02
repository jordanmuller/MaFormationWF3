// Déclaration de fonction
// https://paulund.co.uk/regular-expression-to-validate-email-address
function validateEmail(email){
	var emailReg = new RegExp(/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i);
	var valid = emailReg.test(email);

	if(!valid) {
        return false;
    } else {
    	return true;
    }
};

// -- Initialisation de jQuery
$(function() {
    // -- Ecouter à quel moment est soumis notre formulaire
    // A la soumission de mon formulaire je vais exécuter une fonction anonyme
    // En js : document.getElementById('contact').addEventListener('submit', MaFonctionAExecuter)
    $('#contact').on('submit', function(event) {
        // event correspond ici à notre évènement submit

        // Arrêter la redirection HTML5
        event.preventDefault();

        // -- Suppression des différentes erreurs
        // -- Je supprime la classe has-error en ciblant les élément qui ont la classe "has-error", je supprime la classe sur les éléments que je cible
        $('#contact .has-error').removeClass('has-error');
        $("#contact .text-danger").remove();
        $("#contact .alert-danger").remove();

        // -- La déclaration des variables (Champs à vérifier)
        var nom = $('#nom');
        var prenom = $('#prenom');
        var email = $('#email');
        var tel = $('#tel');

        // -- Je passe à la vérification de chaque champ...
            // -- 1 Vérification du nom
            if (nom.val() == "") {
                // Si le champ nom est vide, on ajoute à son parent la classe has-error, déjà présente dans Bootstrap
                nom.parent().addClass('has-error');

                $("<p class='text-danger'>N'oubliez pas de saisir votre nom</p>").appendTo(nom.parent());
            };
            // Autre façon d'écrire le if si le champ de l'input est vide
            /* if (nom.val().length == 0) {

            }  */
            // -- 2 Vérification du prénom
            if (prenom.val() == "") {
                // Si le champ nom est vide, on ajoute à son parent la classe has-error, déjà présente dans Bootstrap
                prenom.parent().addClass('has-error');

                $("<p class='text-danger'>N'oubliez pas de saisir votre prénom</p>").appendTo(prenom.parent());
            };
            // -- 3 Vérification de l'émail
            if (!validateEmail(email.val())) {
                email.parent().addClass('has-error');

                $("<p class='text-danger'>Vérifiez votre adresse email</p>").appendTo(email.parent());
            };
            // -- 4 Vérification du numéro de téléphone
            if (tel.val() == "" || $.isNumeric(tel.val()) == false) {
                // Si le champ nom est vide, on ajoute à son parent la classe has-error, déjà présente dans Bootstrap
                tel.parent().addClass('has-error');

                $("<p class='text-danger'>Vérifiez votre numéro de téléphone</p>").appendTo(tel.parent());
            };

        if ($(this).find('.has-error').length == 0) {
            $(this).replaceWith('<div class="alert alert-success">Votre demande a bien été envoyée ! Nous vous répondrons dans les meilleurs délais.</div>');
        }   else {
            $(this).prepend('<div class="alert alert-danger">Nous n\'avons pas été en mesure de traiter votre demande.</div>')
        }
    });
});