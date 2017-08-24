<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Exercice 3</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    </head>
    <body>
        <div class="container">
            <h1 class="text-center" style="margin-bottom:40px;">Formulaire pour insérer un nouveau véhicule</h1>
            
            <div class="row"></div>
                <div class="col-md-6 col-md-offset-3">
                    <!-- On affichera dans cette div le message de réussite ou d'erreur renvoyée par la requête ajax -->
                    <div id="resultat"></div>
                    <form action="exercice_3_ajax.php" method="POST" id="form">
                        
                        <div class="form-group">
                            <label class="control-label" for="marque">Marque</label>
                            <input id="marque" name="marque" type="text" class="form-control">
                        </div> <!-- /.form-group -->

                        <div class="form-group">
                            <label class="control-label" for="modele">Modele</label>
                            <input id="modele" name="modele" type="text" class="form-control">
                        </div> <!-- /.form-group -->
                        

                        <div class="form-group">
                            <label class="control-label" for="annee">Annee</label>
                            <select id="annee" name="annee" class="form-control">
                                <option>2017</option>
                                <option>2016</option>
                                <option>2015</option>
                                <option>2014</option>
                                <option>2013</option>
                                <option>2012</option>
                                <option>2011</option>
                            </select>
                        </div> <!-- /.form-group -->

                        <div class="form-group">
                            <label class="control-label" for="couleur">Couleur</label>
                            <select id="couleur" name="couleur" class="form-control">
                                <option value="bleu">Bleu</option>
                                <option value="rouge">Rouge</option>
                                <option value="vert">Vert</option>
                                <option value="gris">Gris</option>
                            </select>
                        </div> <!-- /.form-group -->

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary form-control" id="submit">Envoyer</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!--CDN de jQuery  -->
        <script src="http://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
        <script src="js/script.js"></script>
    </body>
</html>