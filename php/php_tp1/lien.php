<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    
    <?php
        echo '<ul><li><a href="lien.php?pays=france">France</a></li>'; // On peut aussi écrire href="?pays=fr">
        echo '<li><a href="lien.php?pays=italie">Italie</a></li>';
        echo '<li><a href="lien.php?pays=espagne">Espagne</a></li>';
        echo '<li><a href="lien.php?pays=angleterre">Angleterre</a></li></ul>';

        if(isset($_GET['pays']))
        {
            $pays = $_GET['pays'];
            switch ($pays)
            {
                case 'france':
                    echo '<hr>Vous êtes Français ?<br>';
                    break; 
                case 'italie':
                    echo '<hr>Vous êtes Italien ?<br>';
                    break; 
                case 'espagne':
                    echo '<hr>Vous êtes Espagnol ?<br>';
                    break; 
                case 'angleterre':
                    echo '<hr>Vous êtes Anglais ?<br>';
                    break; 
                default:
                    echo '<hr>Votre nationalité n\'est pas reconnue';
            }
        }
    ?>

</body>
</html>