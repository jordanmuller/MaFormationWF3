<?php
    // 2 Récupération des saisies et affichage sur la page
    // 3 insertion des datas dans la bdd INSERT INTO VALUES
    // 4 Affichage des coms dans la page (récup depuis la bdd + traitement)
    // 5 Afficher les derniers coms enregistrés en 1er dans la page
    // 6 Afficher le nombre de coms
    // 7 Afficher la date et l'heure du com en fr
    // 8 css

    // Connexion à la bdd
    $pdo = new PDO('mysql:host=localhost;dbname=commentaire', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));

    $reponse = ""; // Variable pour afficher des messages à l'utilisateur
    // Vérification des champs
    if(isset($_POST['pseudo']) && isset($_POST['message']))
    {
        // Récupération des saisies du formulaire
        // htmlentities() permet d'éviter l'injection de code (sql, css, xss, etc...) Cette fonction transforme les caractères tels que < >, & ... en entités html, cela permet d'avoir un code source propre et de bloquer les injections
        // Le deuxième argument ENT_QUOTES permet la prise en charge également des " et des '
        $pseudo = htmlentities($_POST['pseudo'], ENT_QUOTES);
        $message = htmlentities($_POST['message'], ENT_QUOTES);

        // Affichage des saisies sur la page
        // echo '<b>Pseudo: </b>' . $pseudo . '<br />';
        // echo '<b>Message: </b>' . $message . '<br />';

        // Autre méthode echo '<pre>'; echo print_r($_POST); echo '</pre>';

        // Insertion des données dans la bdd
        // Contrôle sécuritaire des sonnées avec un prepare() puis bindParam(), car c'est l'utilisateur qui rentre les données
        $insertion = $pdo->prepare("INSERT INTO commentaire VALUES (NULL, :message, :pseudo, NOW())");
        $insertion->bindParam(":message", $message, PDO::PARAM_STR);
        $insertion->bindParam(":pseudo", $pseudo, PDO::PARAM_STR);
        // Si le champ message n'est pas vide'
        if(!empty($pseudo) && !empty($message))
        { 
            // execution de l'insertion
            $insertion->execute();
        }
        else {
             $reponse = "<div style='margin: 20px 0; color: white; background-color: DarkRed; padding: 10px;'>Attention les champs pseudo et message sont obligatoires<br />Veuillez recommencer</div>";
            // header() fonction prédéfinie permettant de rediriger vers une url 
            //  /!\ Cette fonction doit être exécutée avant le moindre affichage dans la page
            // header("location:hhtp//www.google.fr");
            // S'il y a de l'affichage avant, on passe par jevascript
            // echo '<script>window.location = "commentaire.php"; </script>';
        }
    }
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="commentaire.css">
        <link rel="stylesheet" href="font-awesome-4.7.0/css/font-awesome.min.css">
        <title>Commentaire</title>
    </head>
    <body>
        <?php
            // Afficher le nombre total de commentaires, doit être placé après l'execution de l'inserrtion
            $nombre_total = $pdo->query("SELECT * FROM commentaire");
            echo '<h2>Nombre total de message(s) : ' . $nombre_total->rowCount() . '<i class="fa fa-envelope-o" aria-hidden="true"></i></h2>';        
        ?>       
        <div class="container">
        <?php echo $reponse; ?>
        <form method="post" action="">
            <label for="pseudo">Pseudo :</label>
            <input type="text" name="pseudo" id="pseudo" value="">
            <label for="message">Votre message :</label>
            <textarea name="message" id="message"></textarea>
            <input type="submit" id="submit" value="Envoyer votre message">
        </form>

        <?php
            
            // Affichage des commentaires dans la page
            // Requête des champs pseudo, message, date et id_commentaire de table commentaire
            $requete = $pdo->query("SELECT pseudo, DATE_FORMAT(date, '%d-%m-%Y à %Hh%imin%ss') AS date, message, id_commentaire FROM commentaire ORDER BY date DESC LIMIT 0, 5");
            
            echo '<section>';
            // Récupération exploitable de la requête par un FETCH_ASSOC et affichage dans une boucle while qui parcourt chaque ligne de la requête (le nombre de lignes total est égal au nombre total de messages)
            while($affichage = $requete->fetch(PDO::FETCH_ASSOC))
            {
                // Vérification de ce que l'on obtient
                // echo '<pre>'; echo print_r($affichage); echo '</pre>';

                // Si l'id commentaire est pair, son modulo est égal à 0
                if($affichage['id_commentaire'] % 2 == 0)
                { 
                echo '<div class="message_pair">';
                    echo '<div class="pseudo">';
                        echo '<i class="fa fa-user-circle" aria-hidden="true"></i>';
                        echo '<b>' . $affichage['pseudo'] . '</b>';
                        echo '<p class="date">' . $affichage['date'] . '</p>';
                    echo '</div>';
                    echo '<p class="texte">' . $affichage['message'] . '</p>';
                echo '</div>';
                } else {
                    echo '<div class="message_impair">';
                    echo '<div class="pseudo">';
                        echo '<i class="fa fa-user-circle-o" aria-hidden="true"></i>';
                        echo '<b>' . $affichage['pseudo'] . '</b>';
                        echo '<p class="date">' . $affichage['date'] . '</p>';
                    echo '</div>';
                    echo '<p class="texte">' . $affichage['message'] . '</p>';
                echo '</div>';
                }
            }
            echo '</section>';


            /*  $nombre = $pdo ->query("SELECT COUNT(*) FROM commentaire");
            $total = $nombre->fetch(PDO::FETCH_ASSOC);
            echo $total;
            */
        ?>
        </div> <!-- /.container -->
    </body>
</html>