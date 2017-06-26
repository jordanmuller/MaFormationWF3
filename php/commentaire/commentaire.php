<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="commentaire.css">
        <title>Commentaire</title>
    </head>
    <body>
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

            // Vérification des champs
            if(isset($_POST['pseudo']) && isset($_POST['message']))
            {
                // Récupération des saisies du formulaire
                $pseudo = $_POST['pseudo'];
                $message = $_POST['message'];

                // Affichage des saisies sur la page
                // echo '<b>Pseudo: </b>' . $pseudo . '<br />';
                // echo '<b>Message: </b>' . $message . '<br />';

                // Insertion des données dans la bdd
                $insertion = $pdo->prepare("INSERT INTO commentaire VALUES (NULL, :message, :pseudo, NOW())");
                $insertion->bindParam(":message", $message, PDO::PARAM_STR);
                $insertion->bindParam(":pseudo", $pseudo, PDO::PARAM_STR);
            }
            
            // Afficher le nombre total de commentaires
            $nombre_total = $pdo->query("SELECT * FROM commentaire");
            echo '<p>Nombre total de message : ' . $nombre_total->rowCount() . '</p>';
        ?>

        <form method="post" action="">
            <label for="pseudo">Pseudo :</label>
            <input type="text" name="pseudo" id="pseudo" value="">
            <label for="message">Votre message :</label>
            <textarea name="message" id="message"></textarea>
            <input type="submit" id="submit" value="Envoyer votre message">
        </form>

            <?php
                if(!empty($message))
                { 
                    //$insertion->execute();
                }
                // Affichage des commentaires dans la page
                $requete = $pdo->query("SELECT pseudo, DATE_FORMAT(date, '%d %m %Y %Hh%imin%ss') AS date, message FROM commentaire ORDER BY date DESC LIMIT 0, 5");
                // Récupération de la requête et affichage
                while($affichage = $requete->fetch(PDO::FETCH_ASSOC))
                {
                    echo '<div class="message">';
                        echo '<div class="pseudo">';
                            echo '<b>' . $affichage['pseudo'] . '</b>';
                            echo '<p class="date">' . $affichage['date'] . '</p>';
                        echo '</div>';
                        echo '<p class="texte">' . $affichage['message'] . '</p>';
                    echo '</div>';
                }



                /*  $nombre = $pdo ->query("SELECT COUNT(*) FROM commentaire");
                $total = $nombre->fetch(PDO::FETCH_ASSOC);
                echo $total;
                */
            ?>
        
    </body>
</html>