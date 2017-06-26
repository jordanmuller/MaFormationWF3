<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Document</title>
        <style>
            * { font-family: calibri; }
            form { width: 25%; min-width: 200px; margin: 0 auto;}
            input { width: 100%; border: 1px solid #dedede; border-radius: 3px; height: 28px;}
        </style>
    </head>
    <body>
        <?php
            echo '<pre>'; print_r($_POST); echo '</pre>';
            // Connexion à la db
            $pdo = new PDO('mysql:host=localhost;dbname=connexion', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));

            if(isset($_POST['pseudo']) && isset($_POST['mdp']))
            {
                // On récupère les valeurs du formulaire dans des variables
                $pseudo = $_POST['pseudo'];
                $mdp = $_POST['mdp'];

                // Récupération des informations en ajoutant la fonction prédéfinie addslashes() pour gérer les quotes et les guillemets
                // $pseudo = addslashes($_POST['pseudo']);
                // $mdp = addslashes($_POST['mdp']);
                // addslashes() rajoute un antislash dès qu'il trouve une quote ou guillemet dans une chaîne de caractères
                echo '<b>Pseudo: </b>' . $pseudo . '<br />';
                echo '<b>Mot de passe: </b>' . $mdp . '<br />';

                // On place la requête dans une variable juste pour l'afficher
                $req = "SELECT * FROM utilisateur WHERE pseudo = '$pseudo' AND mdp = '$mdp'";
                
                // Affichage de la requête pour comprendre les injections
                echo '<b>Requête: </b>' . $req . '<br />';

                // Execution de la requête
                // $resultat = $pdo->query($req);
                // La ligne au dessus permet l'injection de code via le formulaire (injections sql notamment), pour sécuriser, il nous suffit d'utiliser prepare() + execute()

                // On prépare la requête ainsi que l'aspect sécuritaire avec bindParam
                $resultat = $pdo->prepare("SELECT * FROM utilisateur WHERE pseudo = :pseudo AND mdp = :mdp"); // On place deux tokens dans la requête
                $resultat->bindParam(":pseudo", $pseudo, PDO::PARAM_STR);
                $resultat->bindParam(":mdp", $mdp, PDO::PARAM_STR); // On doit donc lier les deux tokens avec bindParam aux valeurs $mdp qu'on lui affecte'

                // On execute la requête et on obtient un résultat inexploitable
                $resultat->execute();
               

                // On rend le résultat exploitable grâce à un fetch assoc
                $membre = $resultat->fetch(PDO::FETCH_ASSOC);
                // Si nous récupérons quelque chose de la bdd
                if(!empty($membre))  // On peut aussi vérifier avec un rowCount != 0 => est-ce qu'il y a au moins une ligne
                {
                    // Alors le pseudo et le mdp sont corrects
                    echo '<h1 style="background-color: green; color: white; padding: 10px;">Vous êtes connecté</h1>';
                    echo '<b>Vos informations : </b><br />';
                    echo '<b>id_utilisateur : </b>' . $membre['id_utilisateur'] . '<br />';
                    echo '<b>Pseudo : </b>' . $membre['pseudo'] . '<br />';
                    echo '<b>Mot de passe : </b>' . $membre['mdp'] . '<br />';
                    echo '<b>Sexe : </b>' . $membre['sexe'] . '<br />';
                    echo '<b>Email : </b>' . $membre['email'] . '<br />';
                    echo '<b>Adresse : </b>' . $membre['adresse'] . '<br />';
                }
                // Si nous ne récupérons rien de la bdd
                else {
                    echo '<h1 style="background-color: red; color: white; padding: 10px;">Erreur sur le pseudo ou le mot de passe<br />Veuillez recommencer</h1>';
                }
                
            }
        ?>

        <hr>
        <form method="post" action="">
            <label for="pseudo">Pseudo :</label>
            <input type="text" name="pseudo" id="pseudo" value="">
            <label for="mdp">Mot de passe :</label>
            <input type="text" name="mdp" id="mdp" value=""><hr>
            <input type="submit" id="submit" value="Se connecter">
        </form>

    
    </body>
</html>