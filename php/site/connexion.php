<?php
require("inc/init.inc.php");

if(isset($_GET['action']) && $_GET['action'] == 'deconnexion')
{
  session_destroy();
}

// Vérification si l'utilisateur est connecté dans ce cas on le redirige sur profil
if(utilisateur_est_connecte())
{
    // header doit être placé avant tout affichage
    header("location:profil.php");
    // session_destroy() s'effectue ici car on se redirige vers la page profil, qui possède son propre header qui renvoie à cette page connexion.php
}

// Vérification de l'existence des indices du formulaire
if(isset($_POST['pseudo']) && isset($_POST['mdp']))
{
    $pseudo = $_POST['pseudo'];
    $mdp = $_POST['mdp'];
    
    $verif_connexion = $pdo->prepare("SELECT * FROM membre WHERE pseudo = :pseudo AND mdp = :mdp");
    $verif_connexion->BindParam(":pseudo", $pseudo, PDO::PARAM_STR);
    $verif_connexion->BindParam(":mdp", $mdp, PDO::PARAM_STR);
    $verif_connexion->execute();

    if($verif_connexion->rowCount() > 0)
    {
        // Si nous avons au moins une ligne alors le pseudo et le mdp sont corrects
        $info_utilisateur = $verif_connexion->fetch(PDO::FETCH_ASSOC);
        
        // On place toutes les informations de l'utilisateur dans la session sauf le mdp
        $_SESSION['utilisateur'] = array();

        $_SESSION['utilisateur']['id_membre'] = $info_utilisateur['id_membre'];
        $_SESSION['utilisateur']['pseudo'] = $info_utilisateur['pseudo'];
        $_SESSION['utilisateur']['nom'] = $info_utilisateur['nom'];
        $_SESSION['utilisateur']['prenom'] = $info_utilisateur['prenom'];
        $_SESSION['utilisateur']['email'] = $info_utilisateur['email'];
        $_SESSION['utilisateur']['sexe'] = $info_utilisateur['sexe'];
        $_SESSION['utilisateur']['ville'] = $info_utilisateur['ville'];
        $_SESSION['utilisateur']['adresse'] = $info_utilisateur['adresse'];
        $_SESSION['utilisateur']['cp'] = $info_utilisateur['cp'];
        $_SESSION['utilisateur']['statut'] = $info_utilisateur['statut'];
        
        // même chose avec un foreach
        /*$_SESSION['utilisateur'] = array();
        foreach($info_utilisateur AS $indice => $valeur) // "=>" est utilisé dans les array, on assigne une valeur à l'indice dans $_SESSION['utilisateur']
        {
          if($indice != 'mdp')
          {
            $_SESSION['utilisateur'][$indice] = $valeur;
          }        
        }*/

        // On redirige sur profil après la connexion
        header("location:profil.php");
        
    } else {
        $message .= '<div class="alert alert-danger" role="alert" style="margin-top: 20px;">Attention, Erreur sur le pseudo ou le mot de passe.<br />Veuillez recommencer !</div>';
    }
    // echo '<pre>'; print_r($_SESSION); echo '</pre>';
}







// Les affichages commencent ici, on termine toujours le php par les affichages
require("inc/header.inc.php");
require("inc/nav.inc.php");
// echo '<pre>'; print_r($_SERVER); echo '</pre>';
// echo '<pre>'; print_r($_GET); echo '</pre>';
?>
    
    <div class="container">

      <div class="starter-template">
        <h1><span class="glyphicon glyphicon-user" style="color: NavajoWhite;"></span> Connexion</h1>
      </div>
      <?php // echo $message; // messages destinés à l'utilisateur ?>
        <!-- Le = est un raccourci de echo, les balises ci dessus et ci dessous sont les mêmes, cela ne fonctionne que pour les echo -->
      <?= $message; ?>
      <div class="row">
        <div class="col-sm-4 col-sm-offset-4">
          <form method="post" action="">
            <div class="form-group">
              <label for="pseudo">Pseudo:</label>
              <!-- On met les value="" pour rafraichir le champ à chaque submit -->
              <input type="text" class="form-control" id="pseudo" name="pseudo" value="">
            </div>  
            <div class="form-group">
              <label for="mdp">Mot de passe:</label>
              <input type="text" class="form-control" id="mdp" name="mdp" value="">
            </div>   
            <button type="submit" name="inscription" id="inscription" style="background: NavajoWhite; color: white;" class="btn form-control">Connexion</button>
              
          </form>
        
      

    </div><!-- /.container -->
<?php
require("inc/footer.inc.php");