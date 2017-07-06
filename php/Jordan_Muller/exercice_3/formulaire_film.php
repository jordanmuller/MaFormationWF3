<?php

// Connexion à la bdd
$pdo = new PDO('mysql:host=localhost;dbname=exercice_3', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));

// Déclaration d'une variable message vide
$message= "";

// Déclaration des variables vides, pour les afficher dans les values du formulaire et ainsi afficher les saisies des utilisateurs
$title = "";
$actors = "";
$director = "";
$producer = "";
$year_of_prod = "";
$language = "";
$category = "";
$storyline = "";
$video = "";

// Vérification de l'existence des champs du formulaire
if(isset($_POST['title']) && isset($_POST['actors']) && isset($_POST['director']) && isset($_POST['producer']) && isset($_POST['year_of_prod']) && isset($_POST['language']) && isset($_POST['category']) && isset($_POST['storyline']) && isset($_POST['video']))
{
    // echo '<pre>'; print_r($_POST); echo '</pre>';
    
    // Récupération des données dans des variables
    $title = $_POST['title'];
    $actors = $_POST['actors'];
    $director = $_POST['director'];
    $producer = $_POST['producer'];
    $year_of_prod = $_POST['year_of_prod'];
    $language = $_POST['language'];
    $category = $_POST['category'];
    $storyline = $_POST['storyline'];
    $video = $_POST['video'];

    /************** Vérification des saisies de l'utilisateur *****************/
    
    // Déclaration d'une variable d'erreur
    $erreur = "";

    // On récupère les longueurs des daisies de l'utilisateur dans les différents champs 
    $title_size = iconv_strlen($title);
    $director_size = iconv_strlen($director);
    $producer_size = iconv_strlen($producer);
    $actors_size = iconv_strlen($actors);
    $storyline_size = iconv_strlen($storyline);
    
    if($title_size < 5)
    {
        $message .= '<div class="alert alert-danger" role="alert" style="margin-top: 20px;">Attention, le titre doit comporter au minimum 5 caractères.<br />Veuillez en saisir un nouveau.</div>';
        $erreur = true;
    }
    if($director_size < 5)
    {
        $message .= '<div class="alert alert-danger" role="alert" style="margin-top: 20px;">Attention, le nom du réalisateur doit comporter au minimum 5 caractères.<br />Veuillez en saisir un nouveau.</div>';
        $erreur = true;
    }
    if($producer_size < 5)
    {
        $message .= '<div class="alert alert-danger" role="alert" style="margin-top: 20px;">Attention, le nom du producteur doit comporter au minimum 5 caractères.<br />Veuillez en saisir un nouveau.</div>';
        $erreur = true;
    }
    if($actors_size < 5)
    {
        $message .= '<div class="alert alert-danger" role="alert" style="margin-top: 20px;">Attention, le nom des acteurs doit comporter au minimum 5 caractères.<br />Veuillez en saisir un nouveau.</div>';
        $erreur = true;
    }
    if($storyline_size < 5)
    {
        $message .= '<div class="alert alert-danger" role="alert" style="margin-top: 20px;">Attention, le synopsis doit comporter au minimum 5 caractères.<br />Veuillez en saisir un nouveau.</div>';
        $erreur = true;
    }

    // Vérification de l'url vidéo avec la fonction filter_var()
    if (!filter_var($video, FILTER_VALIDATE_URL)) 
    {
        $message .= '<div class="alert alert-danger role="alert" style="margin-top: 20px;">Votre URL a un format non adapté.<br />Veuillez en saisir une nouvelle.</div>';
        $erreur = true;
    } 

/**************** AJOUT DU FILM DANS LA BDD *******************/
    
    // S'il n'y a pas d'erreur
    if(!$erreur)
    {
        // On effectue une requête d'insertion avec la méthode prepare par sécurité car c'est l'utilisateur qui rentre les saisies dans le formulaire
        $ajout = $pdo->prepare("INSERT INTO movies VALUES (NULL, :title, :actors, :director, :producer, :year_of_prod, :language, :category, :storyline, :video)");
        
        // On lie les marqueurs nominatifs avec les données saisies par l'utilisateur' 
        $ajout->bindParam(":title", $title, PDO::PARAM_STR);
        $ajout->bindParam(":actors", $actors, PDO::PARAM_STR);
        $ajout->bindParam(":director", $director, PDO::PARAM_STR);
        $ajout->bindParam(":producer", $producer, PDO::PARAM_STR);
        $ajout->bindParam(":year_of_prod", $year_of_prod, PDO::PARAM_STR);
        $ajout->bindParam(":language", $language, PDO::PARAM_STR);
        $ajout->bindParam(":category", $category, PDO::PARAM_STR);
        $ajout->bindParam(":storyline", $storyline, PDO::PARAM_STR);
        $ajout->bindParam(":video", $video, PDO::PARAM_STR);

        // On execute la requête
        $ajout->execute();

        // Message de validation
        $message .= '<div class="alert alert-success role="alert" style="margin-top: 20px;">Félicitations, votre film a été ajouté.</div>';
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

    <title>Formulaire de films</title>

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
            <h1>Ajouter un film</h1>
        </div>
        <div class="row">
            <div class="col-sm-4 col-sm-offset-4">
            <?php echo $message; ?>
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="title">Title:</label>
                        <input type="text" class="form-control" id="title" name="title" value="<?php echo $title; ?>">
                    </div>
                    <div class="form-group">
                        <label for="actors">Actors:</label>
                        <input type="text" class="form-control" id="actors" name="actors" value="<?php echo $actors; ?>">
                    </div>
                    <div class="form-group">
                        <label for="director">Director:</label>
                        <input type="text" class="form-control" id="director" name="director" value="<?php echo $director; ?>">
                    </div>
                    <div class="form-group">
                        <label for="producer">Producer:</label>
                        <input type="text" class="form-control" id="producer" name="producer" value="<?php echo $producer; ?>">
                    </div>
                    <div class="form-group">
                        <label for="year_of_prod">Year of production:</label>
                        <select class="form-control" name="year_of_prod" id="year_of_prod">
                            <?php
                                // On récupère l'année courante en PHP
                                $annee_actuelle = date('Y');
                                // On affiche les années de la plus récente à la plus ancienne
                                for($i = $annee_actuelle; $i >= 1950; $i--)
                                {   
                                    echo '<option>' . $i . '</option>'; 
                                }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="language">Language:</label>
                        <select class="form-control" name="language" id="language">
                            <option>English</option>
                            <option <?php if($language == 'French') { echo 'selected'; } ?>>French</option>
                            <option <?php if($language == 'Spanish') { echo 'selected'; } ?>>Spanish</option>
                            <option <?php if($language == 'Italian') { echo 'selected'; } ?>>Italian</option>
                            <option <?php if($language == 'German') { echo 'selected'; } ?>>German</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="category">Category:</label>
                        <select class="form-control" name="category" id="category">
                            <option value="action">Action</option>
                            <option value="comedy" <?php if($category == 'comedy') { echo 'selected'; } ?>>Comedy</option>
                            <option value="romance" <?php if($category == 'romance') { echo 'selected'; } ?>>Romance</option>
                            <option value="horror" <?php if($category == 'horror') { echo 'selected'; } ?>>Horror</option>
                            <option value="drama" <?php if($category == 'drama') { echo 'selected'; } ?>>Drama</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="storyline">Storyline:</label>
                        <textarea class="form-control" name="storyline" id="storyline"><?php echo $storyline; ?></textarea>
                    </div>
                     <div class="form-group">
                        <label for="video">Video:</label>
                        <input type="text" class="form-control" id="video" name="video" value="<?php echo $video; ?>">
                    </div>
                    <div class="form-group">
                         <button type="submit" name="validation" id="validation" class="btn btn-primary form-control">Ajouter</button>
                    </div>
                </form>
            </div> <!-- /.col-sm-4 -->
        </div><!-- /.row -->
    </div><!-- /.container -->

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>