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
    // Afficher proprement les informations qui proviennent du formulaire
    // Pensez au cas d'erreur, exemple si je viens sur cette page sans valider le formulaire y a-t-'il des erreurs php affichés. Si c'est le cas il faut corriger

    echo '<pre>'; var_dump($_POST); echo '</pre>';

    if (isset($_POST['expediteur']) && isset($_POST['sujet']) && isset($_POST['message']))
    {
      $expediteur = $_POST['expediteur'];
      $sujet = $_POST['sujet'];
      $message = $_POST['message'];

      echo 'L\'expéditeur est ' . $expediteur . '<br />';
      echo 'Le sujet est ' . $sujet . '<br />';
      echo 'Le message est ' . $message . '<br />';

      // Envoi d'un mail via la fonction prédéfinie mail()
      $expediteur = "From: $expediteur \n"; // \n est un retour à la ligne dans un fichier, /!\ obligatoirement entre "" pour qu'il soit interprété, comme une variable en PHP
      $expediteur .= "MIME-Version: 1.0 \r\n";
      $expediteur .= "Content-type: text/html; charset=iso-8859-1 \r\n";

      // echo $expediteur . '<hr>';

      // envoi
      // mail("destinataire", "sujet", "message", "expediteur")
      mail("jordanmuller29@gmail.com", $sujet, $message, $expediteur);
      
    }

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
        <h1><span class="glyphicon glyphicon-envelope" style="color: crimson; margin-right: 5px;"></span>Contact</h1>
      </div>

      <div class="row">
        <div class="col-sm-6 col-sm-offset-3">
          <form action="" method="post">
            <div class="form-group">
              <label for="expediteur">Expéditeur</label>
              <input type="text" name="expediteur" id="expediteur" class="form-control" />
              <label for="sujet">Sujet</label>
              <input type="text" name="sujet" id="sujet" class="form-control" />
              <label for="message">Message</label>
              <textarea name="message" id="message" class="form-control"></textarea>
            </div> 
              <div class="form-group">
                <button class="form-control btn btn-info"><span class="glyphicon glyphicon-star" style="color: red;"></span>Valider<span class="glyphicon glyphicon-star" style="color: red;"></span></button>
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
