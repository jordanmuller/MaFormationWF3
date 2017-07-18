<?php
// inclusion de fichier contenant la connexion BDD ainsi que le lancement d'une session

require_once("inc/init.inc.php");

if(empty($_SESSION['utilisateur']['pseudo']))
{
	header('location:index.php');
}
// echo '<pre>' ; var_dump($_SESSION) ; echo '</pre>'; 
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>Dialogue - Tchat</title>
      <!-- Custom styles for this template -->
      <link href="css/style.css" rel="stylesheet">
    </head>
	<body>
		<div id="conteneur">
			<h2 id="moi"> Bonjour <?php echo $_SESSION["utilisateur"]["pseudo"]; ?></h2>
			<div id="message_tchat"></div>
			<div id="liste_membre_connecte"></div>
			<div class="clear"></div>
			<div id="smiley">
				<img class="smiley" src="smil/smiley1.gif" alt="😉"/>
				<img class="smiley" src="smil/smiley21.gif" alt=":D"/>
				<img class="smiley" src="smil/smiley22.gif" alt=""/>
				<img class="smiley" src="smil/smiley25.gif" alt=""/>
				<img class="smiley" src="smil/smiley26.gif" alt=""/>
			</div>
            <div class="clear"></div>
			
			<!-- Formulaire -->
			
			<div id="formulaire_tchat">
				<form method="post" action="#" id="form">					
					<textarea id="message" name="message" rows="5" maxlength="300"></textarea><br /><br />
                    <div class="clear"></div>
					<input type="submit" name="envoi" value="Envoi" class="submit"/>	
                    <div class="clear"></div>				
				</form>
			</div>
            <div class="clear"></div>
			<div id="postMessage"></div>
		</div>
        <script>
            // récupération de la liste des connectés via un setInterval
            setInterval("ajax(liste_membre_connecte)", 5333);

            // Récupération et affichage de tous les messages postés avec un setInterval() 
            setInterval("ajax(message_tchat)", 1000);

            // Suppression de l'utilisateur dans le fichier pseudo.txt (window c'est le navigateur)
            window.onbeforeunload = function() {
                // Ici, à la place de arg on choisit le nom "retirer"
                ajax("liste_membre_connecte", "retirer");
            }

            // Enregistrement des messages lors de la validation submit() du formulaire
            document.getElementById("form").addEventListener("submit", function(e) {
                e.preventDefault();
                // On peut l'appeler l'id message sans le récupérer au préalable car les id sont uniques
                ajax("postMessage", message.value);
                ajax("message_tchat");
                document.getElementById('message').value = '';
            });

            // Enregistrement des messages lors de la validation du formulaire via la touche entrée
            document.addEventListener("keypress", function(e) {
                if(e.keyCode == 13) // La touche entrée à un keyCode = 13
                {
                    e.preventDefault();
                    // On peut l'appeler l'id message sans le récupérer au préalable car les id sont uniques
                    ajax("postMessage", message.value);
                    ajax("message_tchat");
                    document.getElementById('message').value = '';
                }
            });


            // Déclaration de la fonction Ajax
            // Dans ce cas mode est obligatoire, argument qui a une valeur vide par défaut ne l'est pas
            function ajax(mode, arg = "") {
                if(typeof(mode) == 'object') {
                    mode = mode.id;
                    // Si notre argument mode est de type object, c'est que je ne récupère pas le texte normal de l'argument mais la balise html qui possède cet id puisqu'il est possible de sélectionner un élément directement par son id. Du coup on pioche dedans pour ne récupérer que l'id (mode.id)
                }
                console.log("Mode: " + mode);

                var file = "ajax.php"; // le fichier cible
                var param = "mode=" + mode + "&arg=" + arg; // Les paramètres à fournir sur ajax.php

                if(window.XMLHttpRequest) {
                    var xhttp = new XMLHttpRequest;
                } else {
                    var xhttp = new ActiveXObject("Microsoft.XMLHTTP"); // IE
                }

                xhttp.open("POST", file, true);
                xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

                xhttp.onreadystatechange = function() {
                    if(xhttp.readyState == 4 && xhttp.status == 200) {
                        console.log(xhttp.responseText);
                        var obj = JSON.parse(xhttp.responseText);
                        console.log(obj);

                        document.getElementById(mode).innerHTML = obj.resultat; // On place la réponse dans l'élément HTML dont l'id a été fourni par l'argument mode
                        document.getElementById(mode).scrollTop = message_tchat.scrollHeight; //Permet de descendre le scroll pour voir les derniers messages / ou les derniers membres
                    }
                }
                xhttp.send(param); // On envoie en fournissant les paramètres 
            }
        </script>
	</body>
</html>