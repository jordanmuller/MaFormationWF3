
// https://paulund.co.uk/regular-expression-to-validate-email-address
function validateEmail(email) {
    var emailReg = new RegExp(/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i);
    var valid = emailReg.test(email);

    if(!valid) {
        return false;
    } else {
        return true;
    }
};



// DISPONIBILITE DU DOM
$(function() {

    // Déclaration des variables
    var collectionDeContacts = [];

     // Déclaration des fonctions
    function ajouterContact (unContact) {    
        collectionDeContacts.push(unContact);
        // On cache la phrase aucun contact, on ne la supprime pas, on la passe en display : none
        $('.aucuncontact').hide();
    };

    function reinitFormulaire () {
        // En JS
        // document.getElementById('contact').reset();

        // EnjQuery
        // On utilise un get car on veut récupérer le 1er élément du #contact sélectionné en jQuey, donc renvoyer dans un tableau, comme tous les sélecteurs jQuery
        $("#contact").get(0).reset();
        // On cible avec get(0) lorsque l'on applique des fonctions natives de javascript sur un sélecteur jQuery

        // Autre méthode
        $('#contact .form-control').val('');
    };

    function afficheNotification () {
        $(".alert-contact").fadeIn('slow').delay(1000).fadeOut('slow');
 
    };

    function contactPresent(unContact) {
        // Booleen qui indique la présence ou pas d'un contact
        var estPresent = false;
        
        // On parcourt collectionDeContacts, à la recherche d'une correspondance
        for (i=0; i < collectionDeContacts.length; i++) {
            if (unContact.email === collectionDeContacts[i].email) {
                estPresent = true;

                // On arrête la boucle, plus besoin de poursuivre
                break;
            } 
        } 
        // Return définit une valeur à renvoyer pour la fonction appelante, ici soit true or false
        return estPresent;
    }; 
    
    // Détection de la soumission de mon formulaire
    $('#contact').on('submit', function (event) {
        // Stopper la redirection de la page
        event.preventDefault();

        // Récupération des champs à vérifier
        var nom = $('#nom');    
        var prenom = $('#prenom');    
        var email = $('#email');    
        var tel = $('#tel');    

        // Vérification des informations
        var mesInformationsSontValides = true;

        // TRAITEMENT DU FORMULAIRE
        // Vérification du nom
        if(nom.val().length == 0) {
            mesInformationsSontValides = false;
        }
        // Vérification du prénom
        if(prenom.val().length == 0) {
            mesInformationsSontValides = false;
        }
        // Vérification de l'email
        if(!validateEmail(email.val())) {
            mesInformationsSontValides = false;
        }
        // Vérification du tel
        if(tel.val().length == 0) {
            mesInformationsSontValides = false;
        }

        // ou if (mesInformationsSontValides), vaut true par défaut en l'écrivant comme cela
        if (mesInformationsSontValides === true) {
            // Tout est correct, préparation du contact
            var contact = {
                // "nom" est un string car c'est la clé, les clés des objets sont toujours en string
                "nom" : nom.val(),
                "prenom" : prenom.val(),
                "email" : email.val(),
                "tel" : tel.val()
            };
            var contact_json = JSON.stringify(contact);
            localStorage.setItem("objet", contact_json);
        
            console.log(contactPresent(contact));
            // Vérification avec contactPrésent
            if (!contactPresent(contact)) {
                // Ajout du contact
                ajouterContact(contact);
                afficheNotification();
                $('<tr><td>' + contact.nom + '</td><td>' + contact.prenom + '</td><td>' + contact.email + '</td><td>' + contact.tel + '</td></tr>').appendTo('tbody');
                reinitFormulaire();
            } else {  
                // Message d'erreur
                alert('Ce contact existe déjà');
            }
        } else {
            alert('Attention\nVeulliez bien remplir tous les champs');
        }
        
        console.log(collectionDeContacts);
        
    });
});