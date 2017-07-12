// alert("OK2");
// On peut écrire setInterval('ajax') ou setInterval(ajax)
setInterval('ajax()', 5000);
// setInterval() va exécuter la fonction ajax() toutes les 5secondes

function ajax() {
    // alert('ok');
    if(window.XMLHttpRequest)
    {
        var xhttp = new XMLHttpRequest(); // Pour la plupart des navigateurs
    }
    else {
        var xhttp = new ActiveXObject('Microsoft.XMLHTTP');
    }

    // Le fichier cible
    var file = 'ajax.php';

    xhttp.open('POST', file, true);
    // Obligé pour que la requête soit reconnue en POST, sans qu'on ait à valider le formulaire, ici on change juste champPays
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    xhttp.onreadystatechange = function () {
        if(xhttp.readyState == 4 && xhttp.status == 200) {
            console.log(xhttp.responseText);
            var resultat = JSON.parse(xhttp.responseText);
            document.getElementById("conteneur").innerHTML = resultat.tableau;
            // .tableau représente l'indice du tableau généré sur le script php contenant la réponse, qui elle est au format object JSON 
        }
    }
    xhttp.send();
}