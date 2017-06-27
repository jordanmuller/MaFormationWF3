<?php
require("inc/init.inc.php");


$pseudo = "";
$mdp = "";
$nom = "";
$prenom = "";
$email = "";
$sexe = "";
$ville = "";
$cp = "";
$adresse = "";

// Contrôle sur l'existence de tous les champs provenant du formulaire (sauf le bouton)
if(isset($_POST['pseudo']) && isset($_POST['mdp']) && isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['email']) && isset($_POST['sexe']) && isset($_POST['$ville']) && isset($_POST['cp']) && isset($_POST['adresse']))
{
  $pseudo = $_POST['pseudo'];
  $mdp = $_POST['mdp'];
  $nom = $_POST['nom'];
  $prenom = $_POST['prenom'];
  $email = $_POST['email'];
  $sexe = $_POST['sexe'];
  $ville = $_POST['ville'];
  $cp = $_POST['cp'];
  $adresse = $_POST['adresse'];
}

// Les affichages commencent ici
require("inc/header.inc.php");
require("inc/nav.inc.php");
echo '<pre>'; print_r($_POST); echo '</pre>';

?>
    
    <div class="container">

      <div class="starter-template">
        <h1><span class="glyphicon glyphicon-user" style="color: plum;"></span>Inscription</h1>
      </div>
      <div class="row">
        <div class="col-sm-4 col-sm-offset-4">
          <form method="post" action="">
            <div class="form-group">
              <label for="pseudo">Pseudo:</label>
              <!-- On met les value="" pour rafraichir le champ à chaque submit -->
              <input type="text" class="form-control" id="pseudo" name="pseudo" value="<?php echo $pseudo ?>">
            </div>  
            <div class="form-group">
              <label for="mdp">Mot de passe:</label>
              <input type="text" class="form-control" id="mdp" name="mdp" value="<?php echo $mdp ?>">
            </div>   
            <div class="form-group">
              <label for="nom">Nom:</label>
              <input type="text" class="form-control" id="nom" name="nom" value="<?php echo $nom ?>">
            </div>
            <div class="form-group">
              <label for="prenom">Prénom:</label>
              <input type="text" class="form-control" id="prénom" name="prenom" value="<?php echo $prenom ?>">
            </div>
            <div class="form-group">
              <label for="email">Email:</label>
              <input type="text" class="form-control" id="email" name="email" value="<?php echo $email ?>">
            </div>
            <div class="form-group">
              <label for="sexe">Sexe:</label>
              <select class="form-control" name="sexe" id="sexe">
                <option value="m">Homme</option>
                <option value="f" <?php if($sexe == "f") { echo 'selected'; } ?>>Femme</option>
              </select>
            </div>
            <div class="form-group">
              <label for="ville">Ville:</label>
              <input type="text" class="form-control" id="ville" name="ville" value="<?php echo $ville ?>">
            </div>
            <div class="form-group">
              <label for="cp">Code postal:</label>
              <input type="text" class="form-control" id="cp" name="cp" value="<?php echo $cp ?>">
            </div>
            <div class="form-group">
              <label for="adresse">Adresse:</label>
              <textarea class="form-control" name="adresse" id="adresse"><?php echo $adresse ?></textarea>
            </div>
            <button type="submit" name="inscription" id="inscription" class="btn btn-primary form-control">Inscription</button>
              
  
        </div> <!-- /.col-sm-4 -->
      </div> <!-- /.row -->
        
          
        </form>
        <?php // echo $message; // messages destinés à l'utilisateur ?>
        <!-- Le = est un raccourci de echo, les balises ci dessus et ci dessous sont les mêmes, cela ne fonctionne que pour les echo -->
        <?= $message; ?>
      

    </div><!-- /.container -->
<?php
require("inc/footer.inc.php");