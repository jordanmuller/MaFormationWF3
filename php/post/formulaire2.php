<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Formulaire 2</title>
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
    <form method="POST" action="formulaire2_resultats.php" enctype="multipart/form-data"> <!-- GET par défaut, la norme c'est du POST --> 
        <label for="pseudo">Pseudo</label>
        <input type="text" name="pseudo" id="pseudo" value="" />
        <label for="email">Email</label>
        <input type="texte" id="email" name="email"></textarea><br />
        <input type="submit" id="submit" value="Valider" />
    </form>
</body>
</html>