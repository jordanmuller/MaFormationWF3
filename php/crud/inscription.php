<?php
require_once("inc/init.inc.php");

// Déclaration de variables vides pour affichage dans les values du formulaire
$pseudo = "";
$mdp = "";
$nom = "";
$prenom = "";
$email = "";
$sexe = "";
$ville = "";
$code_postal = "";     
$adresse = "";

// Contrôle sur l'existence de tous les champs provenant du formulaire (sauf le bouton)
if(isset($_POST['pseudo']) && isset($_POST['mdp']) && isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['email']) && isset($_POST['civilite']) && isset($_POST['ville']) && isset($_POST['code_postal']) && isset($_POST['adresse']))
{
    $pseudo = $_POST['pseudo'];
    $mdp = $_POST['mdp'];
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $civilite = $_POST['civilite'];
    $ville = $_POST['ville'];
    $code_postal = $_POST['code_postal'];
    $adresse = $_POST['adresse'];

    // Variable de contrôle des erreurs
    $erreur = "";

    // Contrôle sur la taille du pseudo, nom et prénom (entre 4 et 20 caractères inclus)
    $taille_pseudo = iconv_strlen($pseudo);
    $taille_nom = iconv_strlen($nom);
    $taille_prenom = iconv_strlen($prenom);

    if($taille_pseudo < 4 || $taille_pseudo > 20)
    {
        $content .= '<div class="alert alert-danger" role="alert" style="margin-top: 20px;">Attention, la taille du pseudo est incorrecte.<br />En effet, le pseudo doît être compris entre 4 et 20 caractères inclus.</div>';
        $erreur = true;
    }
    
    if($taille_nom < 4 || $taille_nom > 20)
    {
        $content .= '<div class="alert alert-danger" role="alert" style="margin-top: 20px;">Attention, la taille du nom est incorrecte.<br />En effet, le pseudo doît être compris entre 4 et 20 caractères inclus.</div>';
        $erreur = true;
    }
    
    if($taille_prenom < 4 || $taille_prenom > 20)
    {
        $content .= '<div class="alert alert-danger" role="alert" style="margin-top: 20px;">Attention, la taille du prénom est incorrecte.<br />En effet, le pseudo doît être compris entre 4 et 20 caractères inclus.</div>';
        $erreur = true;
    }

    // Vérification si le pseudo est déjà existant dans la bdd
    $verif_pseudo = $pdo->prepare("SELECT * FROM membre WHERE pseudo = :pseudo");
    $verif_pseudo->bindParam(":pseudo", $pseudo, PDO::PARAM_STR);
    $verif_pseudo->execute();

    if($verif_pseudo->rowCount() > 0)
    {
        $content .= '<div class="alert alert-danger" role="alert" style="margin-top: 20px;">Attention, Ce pseudo existe déjà.<br />Veillez saisir un nouveau pseudo.</div>';
        $erreur = true;
    }

    if(!$erreur)
    {
        $insertion = $pdo->prepare("INSERT INTO membre VALUES (NULL, :pseudo, :mdp, :nom, :prenom, :email, :civilite, :ville, :code_postal, :adresse, 0)");
        $insertion->bindParam(":pseudo", $pseudo, PDO::PARAM_STR);
        $insertion->bindParam(":mdp", $mdp, PDO::PARAM_STR);
        $insertion->bindParam(":nom", $nom, PDO::PARAM_STR);
        $insertion->bindParam(":prenom", $prenom, PDO::PARAM_STR);
        $insertion->bindParam(":email", $email, PDO::PARAM_STR);
        $insertion->bindParam(":civilite", $civilite, PDO::PARAM_STR);
        $insertion->bindParam(":ville", $ville, PDO::PARAM_STR);
        $insertion->bindParam(":code_postal", $code_postal, PDO::PARAM_STR);
        $insertion->bindParam(":adresse", $adresse, PDO::PARAM_STR);
        $insertion->execute();

        $content .= '<div class="alert alert-success" role="alert" style="margin-top: 20px;">Enregistrement réussi.</div>';
    }

}


// Les affichages commencent ici, on termine toujours le php par les affichages
require_once("inc/header.inc.php");
require_once("inc/nav.inc.php");
// echo '<pre>'; print_r($_POST); echo '</pre>';
?>

<section>
    <?php echo $content; ?>
    <div class="row">
        <div class="col-sm-6 col-sm-offset-3">
            <form method="post" action="">
                <div class="form-group">
                    <label for="pseudo">Pseudo:</label>
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
                    <input type="text" class="form-control" id="prenom" name="prenom" value="<?php echo $prenom; ?>">
                </div> 
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="text" class="form-control" id="email" name="email" value="<?php echo $email; ?>">
                </div> 
                <div class="form-group">
                    <label for="civilite">Civlité:</label>
                    <select class="form-control" name="civilite" id="civilite">
                        <option value="m">Homme</option>
                        <option value="f" <?php if($civilite == "f") { echo 'selected'; } ?>>Femme</option>
                    </select>
                </div> 
                <div class="form-group">
                    <label for="ville">Ville:</label>
                    <input type="text" class="form-control" id="ville" name="ville" value="<?php echo $ville; ?>">
                </div> 
                <div class="form-group">
                    <label for="code_postal">Code postal:</label>
                    <input type="text" class="form-control" id="code_postal" name="code_postal" value="<?php echo $code_postal; ?>">
                </div> 
                <div class="form-group">
                    <label for="adresse">Adresse:</label>
                    <textarea name="adresse" id="adresse" class="form-control"><?php echo $adresse; ?></textarea>
                </div> 
                <div class="form-group">
                    <button type="submit" name="inscription" id="inscription" class="btn btn-primary form-control">Inscription</button>
                </div>
            </form>
        </div> <!-- /.col-sm-6 -->
    </div> <!-- /.row -->
</section>

<?php
require_once("inc/footer.inc.php");