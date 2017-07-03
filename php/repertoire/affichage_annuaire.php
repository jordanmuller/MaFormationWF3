<?php
// Connexion à la bdd
$pdo = new PDO('mysql:host=localhost;dbname=repertoire', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));


?>
<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="description" content="">
    <meta name="author" content="Moi">

    <title>formulaire contact</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/style.css" rel="stylesheet">
  </head>

  <body>

    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <a class="navbar-brand" href="#">Project name</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="#">Home</a></li>
            <li><a href="#about">About</a></li>
            <li><a href="#contact">Contact</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

    <div class="container">

      <div class="starter-template">
        <h1>Annuaire</h1>
      </div>

      <table border="1" style="width: 80%; margin: 0 auto; border-collapse: collapse; text-align: center;">
        <tr>
        <?php

        // Requête pour connaître le nombre de colonnes de la bdd 
        $contenu = $pdo->query("SELECT * FROM annuaire");
        $nb_col = $contenu->columnCount();
        for($i = 0; $i < $nb_col; $i++)
        {
          $colonne = $contenu->getColumnMeta($i);
          echo '<th style="padding: 10px;">' . $colonne['name'] . '</th>';
        }
        echo '<th style="padding: 10px;">Modifier</th>';
        echo '<th style="padding: 10px;">Supprimer</th>';

        while($ligne = $contenu->fetch(PDO::FETCH_ASSOC))
        {
          echo '<tr>';
          foreach($ligne AS $info)
          {
            echo '<td style="padding: 10px;">' . $info . '</td>';
          }
          echo '<td style="padding: 10px;"><a href="?action=modifier"><span class="glyphicon glyphicon-pencil btn btn-warning"></span></a></td>';
          echo '<td style="padding: 10px;"><a href="?action=supprimer"><span class="glyphicon glyphicon-trash btn btn-danger"></span></a></td>';
          echo '</tr>';
        }
            
        ?>
        </tr>
      </table>

      <?php
        $nombre_homme = $pdo->query("SELECT * FROM annuaire WHERE sexe = 'm'");
        $nombre_femme = $pdo->query("SELECT * FROM annuaire WHERE sexe = 'f'");
        echo 'Il y a ' . $nombre_homme->rowCount() . ' homme(s) et ' . $nombre_femme->rowCount() . ' femme(s)';
      ?>
    </div><!-- /.container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>