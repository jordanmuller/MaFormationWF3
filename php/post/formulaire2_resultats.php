<style>
        * { font-family: sans-serif; }
        h1 { padding: 10px; background-color: navy; color: white; }
        .erreur { margin-top: 20px; background-color: darkred; color: white; padding: 10px; text-align: center; }
        .succes { margin-top: 20px; background-color: green; color: white; padding: 10px; text-align: center; }
</style>
<a href="formulaire2.php">Retour au formulaire</a>
<hr>

<?php
// Affichage des informations du formulaire via un var_dump()
echo '<pre>'; var_dump($_POST); echo '</pre>' . '<br>';

// On déclare précédemment la variable message avant de faire la validation
$message = "";

// Test de la taille du pseudo

// Si les indices pseudo et mails existent
if(isset($_POST['pseudo']) && isset($_POST['email']))
{ 
    $pseudo = $_POST['pseudo'];
    $email = $_POST['email'];
    // Si la taille du pseudo est compris entre 4 et 14 caractères
    if(iconv_strlen($_POST['pseudo']) >= 4 && iconv_strlen($_POST['pseudo']) <= 14) // on peut placer $pseudo, on le fera tout le temps pour les requêtes MySQL
    {
        // echo 'Le pseudo est: ' . $_POST['pseudo'] . '<br>'; // On peut placer $pseudo
        $message .= '<p class="succes">Votre pseudo est : ' . $pseudo . '</p>'; // On concatène avec .=, on ajoute du contenu sans écraser le contenu précédent
    }
    else {
        // echo 'Votre pseudo ne possède pas le nombre de caractères requis' . '<br>';
        $message .= '<p class="erreur">Attention, la taille du pseudo est invalide<br /> Il doit avoir entre 8 et 14 caractères</p>';
    }
    
    // On doit tester plusieurs variables on écrit plusieurs if et on PROSCRIT les elseif dans ce genre de cas

    // Fonction permettant de contrôler la validité des emails
    if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) // On peut placer $email
    {
        echo 'Cette (' . $_POST['email'] . ') adresse email est considérée comme valide.<br />'; // on peut placer $email
        // echo 'L\'email est: ' . $_POST['email'] . '<br>';
        $message .= '<p class="succes">Votre email est : ' . $email . '</p>';
    } 
    else {
        $message .= '<p class="erreur">Votre adresse email n\'est pas valide.</p>'; 
    }
}

echo '<h1>Résultats</h1>';

echo $message;



