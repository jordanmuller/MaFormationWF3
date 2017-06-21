<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="Jordan">

    <title>Formulaire de contact</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/style.css" rel="stylesheet">
  </head>

  <body>
  <?php
    if(isset($_POST['pseudo']) && isset($_POST['email']))
    {
      $pseudo = $_POST['pseudo'];
      $email = $_POST['email'];

      if(!empty($pseudo) && !empty($email))
      { 
        // Enregistrement de ces informations sur uun fichier créer dynamiquement grâce à php
        // Fonction fopen
        $f = fopen("liste.txt", "a"); // foopen("nomdufichier", "mode")
        // Pour les différents modes dispo
        // http://php.net/manual/fr/function.fopen.php
        fwrite($f, $pseudo . ' - ');
        fwrite($f, $email . "\n"); // retour à la ligne dans le fichier cible
        fclose($f); // fclose est recommandé il ferme le fichier et libère de la ressource sur le serveur
      }
      else {
        echo '<div class="alert alert-danger text-center" role="alert">Attention, le pseudo et le mail sont obligatoires !<br /> Veuillez recommencer.</div>';
      }
    }
    // Pour lire le formulaire, aller sur formulaire_lecture_de_fichier.php

  ?>
    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
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
        <h1><span class="glyphicon glyphicon-envelope" style="color: crimson; margin-right: 5px;"></span>Enregistrement Contact</h1>
      </div>

      <div class="row">
        <div class="col-sm-6 col-sm-offset-3">
          <form action="" method="post">
            <div class="form-group">
              <label for="pseudo">Pseudo</label>
              <input type="text" name="pseudo" id="pseudo" class="form-control" />
              <label for="email">Email</label>
              <input type="text" name="email" id="email" class="form-control" />
            </div> 
              <div class="form-group">
                <button class="form-control btn btn-success"><span class="glyphicon glyphicon-star" style="color: white;"></span>Valider<span class="glyphicon glyphicon-star" style="color: white;"></span></button>
              </div>    
                  
            

          </form>

        </div> <!-- /.col-sm-6 -->
      </div> <!-- /.row -->

    </div><!-- /.container -->



















    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>
