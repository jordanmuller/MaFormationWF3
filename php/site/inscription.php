<?php
require("inc/init.inc.php");

// Vérification si l'utilisateur est connecté dans ce cas on le redirige sur profil
if(utilisateur_est_connecte())
{
    // header doit être placé avant tout affichage, il masque aussi les erreurs
    header("location:profil.php");
}

// Déclaration de variables vides pour affichage dans les values du formulaire
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
if(isset($_POST['pseudo']) && isset($_POST['mdp']) && isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['email']) && isset($_POST['sexe']) && isset($_POST['ville']) && isset($_POST['cp']) && isset($_POST['adresse']))
{
  // Le formulaire a été validé, on place dans ces variables les saisies correspondantes.
  $pseudo = $_POST['pseudo'];
  $mdp = $_POST['mdp'];
  $nom = $_POST['nom'];
  $prenom = $_POST['prenom'];
  $email = $_POST['email'];
  $sexe = $_POST['sexe'];
  $ville = $_POST['ville'];
  $cp = $_POST['cp'];
  $adresse = $_POST['adresse'];

  // Variable de contrôle des erreurs
  $erreur = "";

  // Contrôle sur la taille du pseudo entre (4 et 14 caractères inclus)
  $taille_pseudo = iconv_strlen($pseudo);
  if($taille_pseudo < 4 || $taille_pseudo > 14)
  {
    $message .= '<div class="alert alert-danger" role="alert" style="margin-top: 20px;">Attention, la taille du pseudo est incorrecte.<br />En effet, le pseudo doît être compris entre 4 et 14 caractères inclus.</div>';
    $erreur = true; // Si l'on rentre dans cette condition alors il y a une erreur.
  } 

  // Contrôle des caractères dans le pseudo (autorisés a-z A-Z 0-9 _ - .)
  $verif_caracteres = preg_match('#^[a-zA-Z0-9._-]+$#', $pseudo);
  /*
  // preg_match() va vérifier les caractères contenus dans la variable pseudo selon une expression régulière fournie en 1ere argument.
  // Elle renvoie 1 si tout est ok sinon 0

  // expression : 
  # ou / => permet d'indiquer le début et la fin de l'expression
  ^ => indique que la chaîne ($pseudo) ne peut que commencer par ces caractères (situés entre []).
  $ => indique que la chaîne ($pseudo) ne que finir par ces caractères (situés entre []).
  + => indique que les caractères autorisés peuvent apparaître plusieurs fois.
  [] => contiennent les caractères autorisés
  */

  if(!$verif_caracteres && !empty($pseudo)) 
  {
    // On rentre dans cette condition si verif_caracteres contient 0 donc s'il y a des caractères non-autorisés
    $message .= '<div class="alert alert-danger" role="alert" style="margin-top: 20px;">Attention, caractères non autorisés dans le pseudo.<br />Caractères autorisés: A-Z ET 0-9.</div>';
    $erreur = true; // Si l'on rentre dans cette condition alors il y a une erreur
  }

  // Contrôle sur la validité du format de l'email
  if (!filter_var($email, FILTER_VALIDATE_EMAIL) && !empty($email)) 
  {
    $message .= '<div class="alert alert-danger" role="alert" style="margin-top: 20px;">Attention, votre adresse email est invalide.<br />Veuillez la réécrire.</div>';
    $erreur = true; // Si l'on rentre dans cette condition alors il y a une erreur
  }

  // Contrôle sur la disponibilité du pseudo en BDD
  // On effectue un prepare car en bdd pseudo = $pseudo soit $_POST['pseudo'] on passe par $_POST donc prepare obligatoire, même chose pour $_GET
  $verif_pseudo = $pdo->prepare("SELECT * FROM membre WHERE pseudo = :pseudo");
  $verif_pseudo->bindParam(":pseudo", $pseudo, PDO::PARAM_STR);
  $verif_pseudo->execute();
  
  // On vérifie si la requête $verif_pseudo obtient au moins une ligne de résultat
  if($verif_pseudo->rowCount() > 0)
  {
    $message .= '<div class="alert alert-danger" role="alert" style="margin-top: 20px;">Attention, votre pseudo n\'est pas disponible.<br />Veuillez en saisir un nouveau.</div>';
    $erreur = true; // Si l'on rentre dans cette condition alors il y a une erreur
  }

  // Insertion dans la BDD
  if($erreur !== true) // Si $erreur est différent de true alors les contrôles préalables sont ok
  {
    // Pour crypter (hashage) le mdp
    // $mdp = password_hash($mdp, PASSWORD_DEFAULT); 
    // Pour voir la gestion du mdp lors de la connexion, voir le fichier connexion_avec_mdp_hash.php, avec password_verify
    $insertion = $pdo->prepare("INSERT INTO membre (pseudo, mdp, nom, prenom, email, sexe, ville, cp, adresse, statut) VALUES (:pseudo, :mdp, :nom, :prenom, :email, :sexe, :ville, :cp, :adresse, 0)");
    $insertion->bindParam(":pseudo", $pseudo, PDO::PARAM_STR);
    $insertion->bindParam(":mdp", $mdp, PDO::PARAM_STR);
    $insertion->bindParam(":nom", $nom, PDO::PARAM_STR);
    $insertion->bindParam(":prenom", $prenom, PDO::PARAM_STR);
    $insertion->bindParam(":email", $email, PDO::PARAM_STR);
    $insertion->bindParam(":sexe", $sexe, PDO::PARAM_STR);
    $insertion->bindParam(":ville", $ville, PDO::PARAM_STR);
    $insertion->bindParam(":cp", $cp, PDO::PARAM_STR);
    $insertion->bindParam(":adresse", $adresse, PDO::PARAM_STR);
    $insertion->execute();

    // On redirige sur la page connexion.php
    header("location:connexion.php"); // location: ../../css/machin.php après location on indique un chemin de dossiers
    // header masque les erreurs du traitement php, il faut le passer en commentaire lors de vérification
  }   
}

// Les affichages commencent ici
require("inc/header.inc.php");
require("inc/nav.inc.php");
// echo '<pre>'; print_r($_POST); echo '</pre>';

?>
    
    <div class="container">

      <div class="starter-template">
        <h1><span class="glyphicon glyphicon-user" style="color: plum;"></span> Inscription</h1>
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
              <input type="text" class="form-control" id="pseudo" name="pseudo" value="<?php echo $pseudo; ?>">
            </div>  
            <div class="form-group">
              <label for="mdp">Mot de passe:</label>
              <input type="text" class="form-control" id="mdp" name="mdp" value="<?php echo $mdp; ?>">
            </div>   
            <div class="form-group">
              <label for="nom">Nom:</label>
              <input type="text" class="form-control" id="nom" name="nom" value="<?php echo $nom; ?>">
            </div>
            <div class="form-group">
              <label for="prenom">Prénom:</label>
              <input type="text" class="form-control" id="prénom" name="prenom" value="<?php echo $prenom; ?>">
            </div>
            <div class="form-group">
              <label for="email">Email:</label>
              <input type="text" class="form-control" id="email" name="email" value="<?php echo $email; ?>">
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
              <input type="text" class="form-control" id="ville" name="ville" value="<?php echo $ville; ?>">
            </div>
            <div class="form-group">
              <label for="cp">Code postal:</label>
              <input type="text" class="form-control" id="cp" name="cp" value="<?php echo $cp; ?>">
            </div>
            <div class="form-group">
              <label for="adresse">Adresse:</label>
              <textarea class="form-control" name="adresse" id="adresse"><?php echo $adresse; ?></textarea>
            </div>
            <button type="submit" name="inscription" id="inscription" class="btn btn-primary form-control">Inscription</button>
              
          </form>
        </div> <!-- /.col-sm-4 -->
      </div> <!-- /.row -->
        
          
        
        
      

    </div><!-- /.container -->
<?php
require("inc/footer.inc.php");