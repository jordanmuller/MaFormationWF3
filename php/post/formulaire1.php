<?php

// $_POST est une superglobale donc un tableau ARRAY
// $_POST est toujours existant mais par défaut est vide
// $_POST nous permet de récupérer les informations provenant d'un formulaire.
// L'indice correspondant à la saisie d'un champ sera l'attribut name="" du champ

?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Formulaire 1</title>
        <style>
            * { font-family: sans-serif; }
            form { width: 30%; margin: 0 auto; }
            label { display: inline-block; width: 100%; font-style: italic; }
            input, textarea { height: 30px; border: 1px solid #eee; width: 100%; resize: none; }
            #submit { width: 140px; }
            textarea { height: 60px; }
        </style>
    </head>
    <body>
    <?php
        if(isset($_POST['pseudo']) && isset($_POST['message'])) // if(!empty($_POST)) est un pré-contrôle mais moins sécurisé que le 1er, isset est imparable
        { 
            echo '<pre>'; print_r($_POST); echo '</pre>' . '<br>';
            echo 'Le pseudo est: ' . $_POST['pseudo'] . '<br>';
            echo 'Le message est: ' . $_POST['message'] . '<br>';
        }
    ?>
        <form method="POST" action="" enctype="multipart/form-data"> <!-- GET par défaut, la norme c'est du POST --> 
            <label for="pseudo">Pseudo</label>
            <input type="text" name="pseudo" id="pseudo" value="" />
            <label for="message">Message</label>
            <textarea id="message" name="message"></textarea><br />
            <input type="submit" id="submit" value="Valider" />
        </form>
    </body>
</html>