<?php
// Variable de message vide
$message = "";

// Variable d'affichage vide qui se remplira au cours des traitements
$affichage = ""; 

// Connexion à la bdd
$pdo = new PDO('mysql:host=localhost;dbname=exercice_3', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));

// Si id_movie n'existe pas, est vide ou que sa valeur n'est pas un numéro
if(empty($_GET['id_movie']) || !is_numeric($_GET['id_movie']))
{
    // On affiche un message d'erreur
    $message .= '<div class="alert alert-danger" role="alert" style="margin-top: 20px;">Attention, le film demandé n\'existe pas<br />Veuillez sélectionner un autre film.</div>';
} else {
    $id_movie = $_GET['id_movie'];
    $fiche = $pdo->prepare("SELECT * FROM movies WHERE id_movie = :id_movie");
    $fiche->bindParam(":id_movie", $id_movie, PDO::PARAM_STR);
    $fiche->execute();

    // Si la requête dans la bdd ne renvoie aucune ligne, alors l'id_movie, dans l'URL, passé en paramètre n'existe pas dans la table movies
    if($fiche->rowCount() < 1)
    {
        // On affiche un message d'erreur
        $message .= '<div class="alert alert-danger" role="alert" style="margin-top: 20px;">Attention, le film demandé n\'existe pas<br />Veuillez sélectionner un autre film</div>'; 
    } else {
        // Si l'id correspond, alors on traite les données
        $contenu = $fiche->fetch(PDO::FETCH_ASSOC);
        
        // On parcourt le contenu de la requête avec un foreach
        foreach($contenu AS $indice => $info)
        {
            $affichage .= '<p><b>' . $indice . '</b>: ' . $info . '</p><hr />';
        }
    } 
}





?>

<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="description" content="">
    <meta name="author" content="Moi">

    <title>Fiche d'un film</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/style.css" rel="stylesheet">
  </head>

  <body>

    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">

          <a class="navbar-brand" href="formulaire_film.php">Ajouter un film</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="affichage.php">Affichage des films</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

    <div class="container">

        <div class="starter-template">
            <h1>Fiche du film</h1>
        </div>

        <!-- On affiche un message d'erreur le cas échéant -->
        <?php echo $message; ?>

        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h2 class="panel-title" style="text-align: center; font-size: 22px;">Descriptif du film</h2>
                    </div>
                    <div class="panel-body">
                        <?php
                            echo $affichage;
                        ?>
                        <a href="affichage.php" class="btn btn-info">Retour à la liste des films</a>
                    </div> <!-- /.panel-body -->
                </div> <!-- /.panel -->
            </div> <!-- /.col-sm-12 -->
        </div> <!-- /.row -->
    
    
    </div><!-- /.container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>