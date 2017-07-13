<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Connexion</title>
    </head>
    <body>
        <form method="POST" action="" id="formulaire">
            <label for="pseudo">Pseudo:</label>
            <input type="text" name="pseudo" id="pseudo">
            <label for="mdp">Mot de passe:</label>
            <input type="text" name="mdp" id="mdp">
            <input type="submit" id="submit" value="Se connecter" />
        </form>
        <hr />
        <div id="resultat"></div>
        <script>
            var formulaire = document.getElementById("formulaire");
            
            // A chaque soumission du formulaire par l'utilisateur
            formulaire.addEventListener("submit", blocage);

            // On bloque la redirection du formulaire
            function blocage (e) { 
                // Arrêt de la redirection du formulaire vers la page php
                e.preventDefault();
                ajax();
            }

            // On peut écrire: 
            /*
            document.getElementById("formulaire").addEventListener("submit", function(e) {
                e.preventDefault();
            })
            */
            // On déclare la fonction ajax
            function ajax() {
                // Déclaration du fichier cible
                var file = "ajax.php";

                if(window.XMLHttpRequest)
                    var xhttp = new XMLHttpRequest(); // Pour la plupart des navigateurs
                else
                    var xhttp = new ActiveXObject("Microsoft.XMLHTTP"); //Pour IE

                var p = document.getElementById("pseudo");
                var pseudo = p.value; // récupération de la valeur du pseudo
                console.log("Pseudo: " + pseudo);
                var m = document.getElementById("mdp");
                var mdp = m.value // récupération de la valeur du mot de passe
                console.log("Mot de passe: " + mdp);

                // Parameters
                var param ="pseudo=" + pseudo + "&mdp=" + mdp;

                xhttp.open("POST", file, true);
                // Obligé pour que la requête soit reconnue en POST, sans qu'on ait à valider le formulaire
                xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded"); 

                xhttp.onreadystatechange = function () {
                    if(xhttp.readyState == 4 && xhttp.status == 200) {
                        // Cette ligne permet de corriger son PHP à partir de la console du navigateur,  il doit être placé avant le JSON.parse()
                        console.log(xhttp.responseText);
                        // On convertit la réponse HTTP (array PHP encodé au format JSON) en objet JSON
                        var result = JSON.parse(xhttp.responseText);
                        // On obtient l'objet result avec la clé resultat
                        console.log(result);
                        // La propriété resultat est l'indice du tableau défini en PHP sur ajax.php
                        document.getElementById("resultat").innerHTML = result.resultat;
                    }
                }
                xhttp.send(param);
            }
                
        </script>
    </body>
</html>

