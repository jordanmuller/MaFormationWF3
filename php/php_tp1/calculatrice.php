<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="Jordan">

    <title>Calculatrice</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/style.css" rel="stylesheet">
  </head>

  <body>

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
        <h1><span class="glyphicon glyphicon-envelope" style="color: crimson; margin-right: 5px;"></span>Calculatrice php</h1>
      </div>

      <div class="row">
        <div class="col-sm-6 col-sm-offset-3">
          <form class="form-inline" method="post" action="">
            <div class="form-group">
                <input type="text" class="form-control" id="chiffre1" name="chiffre1">
            </div>

            <div class="form-group">
                <select class="form-control" id="signe" name="signe">
                    <option value="+">+</option>
                    <option value="-">-</option>
                    <option value="*">*</option>
                    <option value="/">/</option>
                </select>
            </div>

            <div class="form-group">
                <input type="text" class="form-control" id="chiffre2" name="chiffre2">
            </div>
            <button type="submit" class="btn btn-default">Calculer</button>
        </form>

        <?php

            if(isset($_POST['chiffre1']) && isset($_POST['signe']) && isset($_POST['chiffre2']))
            {
                $chiffre1 = $_POST['chiffre1'];
                $signe = $_POST['signe'];
                $chiffre2 = $_POST['chiffre2'];

                if (is_numeric($chiffre1) && is_numeric($chiffre2))
                { 
                  if($signe == '+')
                  {
                      echo $chiffre1 + $chiffre2 . '<br />';
                  }
                  if($signe == "-")
                  {
                      echo $chiffre1 - $chiffre2 . '<br />';
                  }
                  if($signe == "*")
                  {
                      echo $chiffre1 * $chiffre2 . '<br />';
                  }
                  if($signe == "/")
                  {
                      echo $chiffre1 / $chiffre2 . '<br />';
                      if($chiffre2 == 0)
                      {
                          echo 'Il est impossible de diviser par zéro';
                      }
                  }
               }   
            }

        ?>

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
