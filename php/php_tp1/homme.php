<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Homme</title>
</head>
<body>
    
    <?php
        echo'<p><a href="?sexe=homme">Homme</a></p>';
        echo'<p><a href="?sexe=femme">Femme</a></p>';

        if(isset($_GET['sexe']))
        {
            $sexe = $_GET['sexe'];
            if ($sexe == 'homme')
            {
                echo 'Vous êtes un homme.<br>';
            }
            elseif ($sexe == 'femme')
            {
                echo 'Vous êtes une femme.<br>';
            }
        }

    ?>

</body>
</html>