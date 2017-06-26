<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Carte de restaurant</title>
</head>
<body>
    <h1>Carte de restaurant</h1>
    <p><a href="?plat=pizza">Pizza</a></p>
    <p><a href="?plat=salade">Salade</a></p>
    <p><a href="?plat=viande">Viande</a></p>
    <p><a href="?plat=poisson">Poisson</a></p>

    <?php

    $message = "";

    if(isset($_GET['plat']))
    {
        
        $plat = $_GET['plat'];
        switch($plat)
        {
            case 'pizza':
                $message .= 'Vous avez choisi une pizza';
                break;
            case 'salade':
                $message .= 'Vous avez choisi une salade';
                break;
            case 'viande':
                $message .= 'Vous avez choisi une viande';
                break;
            case 'poisson':
                $message .= 'Vous avez choisi un poisson';
                break;
            default:
                $message .= 'Vous n\'avez rien choisi'; 
                break;
        }
    }
    echo $message; 

    ?>
</body>
</html>