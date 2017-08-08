<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Entrainement</title>
    </head>
    <body>
        <form id="form">       
            <label for="">Nom</label>
            <input type="text" name="nom">
        
            <label for="">Prenom</label>
            <input type="text" name="prenom">
            <input type="submit" value="Envoyer">
        </form>
        <div id="response"></div>
        <script
            src="http://code.jquery.com/jquery-1.12.4.min.js"
            integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ="
            crossorigin="anonymous"></script>
            <script>
                $(function() {
                    $('#form').submit(function(e) {
                        e.preventDefault();
                        // On récupère le form en tant qu'objet jQuery
                        var $this = $(this);

                        var data = $this.serialize(); // transforme le résultat du form en objet Json

                        $.post(
                            'back.php', // La page qu'on appele avec la requête AJAX
                            data, // Les données envoyées
                            function(response) { // la fonction qui traite la réponse de l'appel
                                console.log(response);

                                var message;

                                if(response.status == 'ok') {
                                    message = 'Tout est ok.'
                                } else {
                                    message = '<b>Il y a des erreurs.</b>';
                                    message += '<br>' + response.errors.join('<br>');
                                }

                                $('#response').html(message);
                            },
                            'json' // type de retour, par besoin de json_decode
                        );
                    })
                })
                
            </script>
    </body>
</html>