<!-- Exercice 1.1 -->
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
    if(isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['adresse']) && isset($_POST['ville']) && isset($_POST['code_postal']) && isset($_POST['sexe']) && isset($_POST['description']))
    {
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $adresse = $_POST['adresse'];
        $ville = $_POST['ville'];
        $code_postal = $_POST['code_postal'];
        $sexe = $_POST['sexe'];
        $description = $_POST['description'];

        echo 'Le nom est : ' . $nom . '<br />';
        echo 'Le prénom est : ' . $prenom . '<br />';
        echo 'L\'adresse est : ' . $adresse . '<br />';
        echo 'La ville est : ' . $ville . '<br />';
        echo 'Le cp est : ' . $code_postal . '<br />';
        echo 'Le sexe est : ' . $sexe . '<br />';
        echo 'La description est : ' . $description . '<br />';

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
              <label for="nom">Nom</label>
              <input type="text" name="nom" id="nom" class="form-control" />
              <label for="prenom">Prénom</label>
              <input type="text" name="prenom" id="prenom" class="form-control" />
              <label for="adresse">Adresse</label>
              <input type="text" name="adresse" id="adresse" class="form-control" />
              <label for="ville">Ville</label>
              <input type="text" name="ville" id="ville" class="form-control" />
              <label for="code_postal">Code postal</label>
              <input type="text" name="code_postal" id="code_postal" class="form-control" />
              <label for="sexe">Sexe</label>
              <select class="form-control" id="sexe" name="sexe">
                  <option value="homme">Homme</option>
                  <option value="femme">Femme</option>
               </select>   
              <label for="description">Description</label>
              <textarea name="description" id="description" class="form-control"></textarea>
            </div> 
              <div class="form-group">
                <button class="form-control btn btn-info"><span class="glyphicon glyphicon-star" style="color: red;"></span>Envoi<span class="glyphicon glyphicon-star" style="color: red;"></span></button>
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
