<?php
// echo '<pre>'; var_dump($_SERVER); echo '</pre>';
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Accueil - Connexion</title>
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body>
        <div class="contenu">
            <fieldset>
                <div id="message"></div>
            </fieldset>
            <fieldset>
                <form method="post" action="#" id="form">
                    <label for="pseudo">Pseudo</label>
                    <input type="text" name="pseudo" id="pseudo" />
                    <label for="sexe">Sexe:</label>
                    <select name="sexe" id="sexe">
                        <option value="m">Homme</option>
                        <option value="f">Femme</option>
                    </select><br /><br />
                    <label for="ville">Ville:</label>
                    <input type="text" name="ville" id="ville" />
                    <label for="date_de_naissance">Date de naissance:</label>
                    <input type="date" name="date_de_naissance" id="date_de_naissance" value="" placeholder="YYYY/MM/DD" />
                    <br /><br />
                    <input type="submit" value="Connexion au tchat !" />
                </form>
            </fieldset>
        </div>
    </body>
    <script>
        document.getElementById("form").addEventListener("submit", function(e) {
            e.preventDefault();
            ajax()
        })

        function ajax() {
            

            var p = document.getElementById("pseudo");
            var pseudo = p.value;
            // console.log("Pseudo: " + pseudo);
            var s = document.getElementById("sexe");
            var sexe = s.value;
            // console.log("Sexe: " + sexe);
            var v = document.getElementById("ville");
            var ville = v.value;
            // console.log("Ville: " + ville);
            var d = document.getElementById("date_de_naissance");
            var date_de_naissance = d.value;
            // console.log("Date de naissance: " + date_de_naissance);

            // Parameters
            var param = "pseudo=" + pseudo + "&sexe=" + sexe + "&ville=" + ville + "&date_de_naissance=" + date_de_naissance;
            console.log(param);

            var file = "ajax_connexion.php";

            if(window.XMLHttpRequest)
                var xhttp = new XMLHttpRequest(); // Pour la plupart des navigateurs
            else
                var xhttp = new ActiveXObject("Microsoft.XMLHTTP"); //Pour IE

            xhttp.open("POST", file, true);

            // Obligé pour que la requête soit reconnue en POST, sans qu'on ait à valider le formulaire
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded"); 

            xhttp.onreadystatechange = function() {
                if(xhttp.readyState == 4 && xhttp.status == 200) {
                    // Cette ligne permet de corriger son PHP à partir de la console du navigateur,  il doit être placé avant le JSON.parse()
                    console.log(xhttp.responseText);
                    // document.getElementById("message").innerHTML = xhttp.responseText;
                    var reponse = JSON.parse(xhttp.responseText);
                    document.getElementById("message").innerHTML = reponse.resultat;

                    if(reponse.pseudo == 'disponible') {
                        // Si la valeur de l'indice pseudo de l'objet reponse est 'disponible' alors je sais qu'il n'y a pas eu d'erreur et on redirige sur dialogue.php
                        window.location.href = "dialogue.php";
                        // Le href simule l'action cliquer sur un lien
                    }
                }
            }
            xhttp.send(param);
        }
    </script>
</html>