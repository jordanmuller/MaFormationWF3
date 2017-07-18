<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Ajax JSON</title>
    </head>
    <body>
        <form method="post" action="ajax_json.php" id="form" style="width: 50%; margin: 0 auto;">
            <?php
                $fichier = file_get_contents("fichier.json"); // On récupère le contenu du fichier .json
                $json = json_decode($fichier, true); // On transforme le format json en tableau array

                echo '<select name="personne" id="personne" style="width: 100%; display: block; min-height: 28px; margin: 0 auto; border: 1px solid #dedede; border-radius: 3px;">';
                
                    foreach($json AS $sous_tableau)
                    {
                        echo '<option>' . $sous_tableau['prenom'] . '</option>';
                    }
                
                echo '</select><br />';

                echo '<input type="submit" id="submit" value="Valider" style="width: 100%;" />';
            ?>
        </form>

        
        <hr />
        <div id="resultat">
            
        </div> 
        <script
            src="https://code.jquery.com/jquery-1.12.4.min.js"
            integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ="
            crossorigin="anonymous"></script>

            <script>
                $(document).ready(function() {
                    $("#form").on("submit", function(event) {
                        event.preventDefault();

                        // On récupère la valeur du champ select
                        var perso = $("#personne").val();
                        var param = "personne=" + perso;

                        // La méthode .serialize() récupère tous les name et valeurs d'un formulaire et nous l'envoi dans un format correct (GET)
                        var parametres = $(this).serialize();
                        console.log(parametres);
                        // eQUIVALENT EN js FormData https://developer.mozilla.org/fr/docs/Web/API/FormData
                    
                        // Fichier cible, on récupère la valeur de l'attribut action="" du formulaire
                        var file = $(this).attr("action");
                        console.log(file);

                        // Méthode, on récupère la valeur de l'attribut méthod="" du formulaire
                        var method = $(this).attr("method");
                        console.log(method);

                        // api http://api.jquery.com/jquery.ajax/

                        $.ajax({
                            // url: "ajax_json.php"
                            url: file,
                            // type: "POST"
                            type: method,
                            // data: "personne=" + perso;
                            data: param,
                            // Il faut préciser le format des données reçues
                            dataType: "json",
                            success: function(reponse) {
                                // La fonction qui sera exécutée lors de la réception de la réponse
                                $("#resultat").html(reponse.resultat);
                            }
                        });

                        /*// Avec la méthode de jquery post
                        $.post(file, param, function(reponse) {
                            $("#resultat").html(reponse.resultat);
                        }, "json");
                        // $.post(fichier_cible, parametres, function_a_declencher()  {}, format )*/
                    });
                });
            </script>
    </body>
</html>