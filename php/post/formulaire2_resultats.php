<a href="formulaire2.php">Retour au formulaire</a>
<hr>

<?php
// Affichage des informations du formulaire via un var_dump()
echo '<pre>'; var_dump($_POST); echo '</pre>' . '<br>';


// Test de la taille du pseudo

// Si les indices pseudo et mails existent
if(isset($_POST['pseudo']) && isset($_POST['email']))
{ 
    // Si la taille du pseudo est compris entre 4 et 14 caractères
    if(iconv_strlen($_POST['pseudo']) >= 4 && iconv_strlen($_POST['pseudo']) <= 14)
    {
        echo 'Le pseudo est: ' . $_POST['pseudo'] . '<br>';
    }
    else {
        echo 'Votre pseudo ne possède pas le nombre de caractères requis' . '<br>';
    }
    
    // Fonction permettant de contrôler des emails
    if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) 
    {
        echo 'Cette (' . $_POST['email'] . ') adresse email est considérée comme valide.';
        // echo 'L\'email est: ' . $_POST['email'] . '<br>';
    } 
    else {
        echo 'Votre adresse email n\'est pas valide'; 
    }
}




