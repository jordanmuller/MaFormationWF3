<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="description" content="">
    <meta name="author" content="Moi">

    <title>Formulaire répertoire</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/style.css" rel="stylesheet">
  </head>

  <body>
  <?php
    // Connexion à la bdd
    $pdo = new PDO('mysql:host=localhost;dbname=repertoire', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
    


    // Vérification des champs
    if(isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['telephone']) && isset($_POST['profession']) && isset($_POST['ville']) && isset($_POST['codepostal']) && isset($_POST['adresse']) && isset($_POST['date_de_naissance']) && isset($_POST['sexe']) && isset($_POST['description']))
    {   
        // Récupération des saisies du formulaire
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $telephone = $_POST['telephone'];
        $profession = $_POST['profession'];
        $ville = $_POST['ville'];
        $codepostal = $_POST['codepostal'];
        $adresse = $_POST['adresse'];
        $date_de_naissance = $_POST['date_de_naissance'];
        $sexe = $_POST['sexe'];
        $description = $_POST['description'];

        // echo '<pre>'; print_r($_POST); echo '</pre>';

        // Insertion des données dans la table annuaire
        $insertion = $pdo->prepare("INSERT INTO annuaire VALUES (NULL, :nom, :prenom, :telephone, :profession, :ville, :codepostal, :adresse, :date_de_naissance, :sexe, :description)");
        $insertion->bindParam(":nom", $nom, PDO::PARAM_STR);
        $insertion->bindParam(":prenom", $prenom, PDO::PARAM_STR);
        $insertion->bindParam(":telephone", $telephone, PDO::PARAM_STR);
        $insertion->bindParam(":profession", $profession, PDO::PARAM_STR);
        $insertion->bindParam(":ville", $ville, PDO::PARAM_STR);
        $insertion->bindParam(":codepostal", $codepostal, PDO::PARAM_STR);
        $insertion->bindParam(":adresse", $adresse, PDO::PARAM_STR);
        $insertion->bindParam(":date_de_naissance", $date_de_naissance, PDO::PARAM_STR);
        $insertion->bindParam(":sexe", $sexe, PDO::PARAM_STR);
        $insertion->bindParam(":description", $description, PDO::PARAM_STR);
        $insertion->execute();
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
        <h1>Formulaire répertoire</h1>        
      </div>
      
      <div class="row">
        <div class="col-sm-4 col-sm-offset-4">
            <form action="affichage_annuaire.php" method="post">
                <fieldset>
                    <legend>Informations</legend>
                    <div class="form-group">
                        <label for="nom">Nom:</label>
                        <input class="form-control" type="text" id="nom" name="nom">
                    </div>
                    <div class="form-group">
                        <label for="prenom">Prenom:</label>
                        <input class="form-control" type="text" id="prenom" name="prenom">
                    </div>
                    <div class="form-group">
                        <label for="telephone">Telephone:</label>
                        <input class="form-control" type="text" id="telephone" name="telephone">
                    </div>
                    <div class="form-group">
                        <label for="profession">Profession:</label>
                        <input class="form-control" type="text" id="profession" name="profession">
                    </div>
                    <div class="form-group">
                        <label for="ville">Ville:</label>
                        <input class="form-control" type="text" id="ville" name="ville">
                    </div>
                    <div class="form-group">
                        <label for="codepostal">Code postal:</label>
                        <input class="form-control" type="text" id="codepostal" name="codepostal">
                    </div>
                    <div class="form-group">
                        <label for="adresse">Adresse:</label>
                        <input class="form-control" type="text" id="adresse" name="adresse">
                    </div>
                    <div class="form-group">
                        <label for="date_de_naissance">Date de naissance:</label>
                        <input class="form-control" type="text" id="date_de_naissance" name="date_de_naissance">
                    </div>
                    <div class="form-group">
                        <label for="sexe">Sexe:</label>
                        <select name="sexe" id="sexe">
                            <option value="m">Homme</option>
                            <option value="f">Femme</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="description">Description:</label>
                        <textarea class="form-control" id="description" name="description"></textarea>
                    </div>
                </fieldset>
                <input type="submit" class="form-control button btn btn-primary" value="Valider">
            </form>
        </div><!-- /.col-sm-4 -->
      </div><!-- /.row -->

    </div><!-- /.container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>