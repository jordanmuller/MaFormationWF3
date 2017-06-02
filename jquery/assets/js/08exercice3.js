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
var contacts = [];
// Introduction de jQuery
$(function() {
    $('#contact').on('submit', function (e) {
        e.preventDefault();
         
        var nom = $('#nom');    
        var prenom = $('#prenom');    
        var email = $('#email');    
        var tel = $('#tel');    
        $('#contact .has-error').removeClass('has-error');
        $("#contact .text-danger").remove();
        $("#contact .alert-danger").remove();
        $("#contact .alert-info").remove();
        
    
        function ajouterContact (utilisateur) {    
            contacts.push(utilisateur);
        };

        function reinitFormulaire () {
            $("#contact")[0].reset();
        };

        function afficheNotification () {
            $(".alert-contact").slideDown('slow').delay(1000).slideUp('slow');
        };
        function contactPresent (utilisateur) {
            for (i=0; i < contacts.length; i++) {
                if (contacts[i].email === utilisateur.email) {
               
                return true;
                }   else if (i == contacts.length - 1) {
                    return false;
                }
            
            }
        };    
         

        if (nom.val() == "") {
            nom.parent().addClass('has-error');
            $("<p class='text-danger'>N'oubliez pas de saisir votre nom</p>").appendTo(nom.parent());
        }
        if (prenom.val() == "") {
            prenom.parent().addClass('has-error');
            $("<p class='text-danger'>N'oubliez pas de saisir votre prénom</p>").appendTo(prenom.parent());
        }
        if (!validateEmail(email.val())) {
            email.parent().addClass('has-error');
            $("<p class='text-danger'>La saisie de votre email est incorrecte</p>").appendTo(email.parent());
        } 
        if (tel.val() == "" || $.isNumeric(tel.val()) == false) {
            tel.parent().addClass('has-error');
            $("<p class='text-danger'>Vérifier votre numéro de téléphone</p>").appendTo(tel.parent());    
              
        };
        if ($(this).find('.has-error').length == 0) {
            var utilisateur = {
            "nom"    : nom.val(),
            "prenom" : prenom.val(),
            "email"  : email.val(),
            "tel"    : tel.val() 
            };
            contactPresent(utilisateur);
            if (!contactPresent(utilisateur)) {
                ajouterContact(utilisateur);
                afficheNotification();
                $('.aucuncontact').remove();
                $("#LesContacts").find("tbody").append('<tr><td>' + utilisateur.nom + "</td><td>" + utilisateur.prenom + "</td><td>" + utilisateur.email + "</td><td>" + utilisateur.tel + "</td></tr>");
                reinitFormulaire();

            } else {
                 $('#contact').prepend('<div class="alert alert-danger">Ce contact existe déjà.</div>');
            }
       
        }
    });
});