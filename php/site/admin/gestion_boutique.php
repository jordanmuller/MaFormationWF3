<?php
require("../inc/init.inc.php");

// Si l'utilisateur est connecté en admin
if(utilisateur_connecte_admin())
{
  // Déclaration de variables vides pour affichage dans les values du formulaire
  $reference = "";
  $categorie = "";
  $titre = "";
  $description = "";
  $couleur = "";
  $taille = "";
  $sexe = "";
  $prix = "";
  $stock = "";
  $photo_bdd = "";

  if(isset($_POST['reference']) && isset($_POST['categorie']) && isset($_POST['titre']) && isset($_POST['description']) && isset($_POST['couleur']) && isset($_POST['taille']) && isset($_POST['sexe']) && isset($_FILES['photo']) && isset($_POST['prix']) && isset($_POST['stock']))
  {
    $reference = $_POST['reference']; 
    $categorie = $_POST['categorie']; 
    $titre = $_POST['titre']; 
    $description = $_POST['description']; 
    $couleur = $_POST['couleur']; 
    $taille = $_POST['taille']; 
    $sexe = $_POST['sexe']; 
    $prix = $_POST['prix']; 
    $stock = $_POST['stock'];   


/********************* VERIFICATION *******************************/
$erreur = "";

    // Contrôle sur la disponibilité de la référence en BDD
    $verif_ref = $pdo->prepare("SELECT * FROM article WHERE reference = :reference");
    $verif_ref->bindParam(":reference", $reference, PDO::PARAM_STR);
    $verif_ref->execute();

    if($verif_ref->rowCount() > 0)
    {
      $message .= '<div class="alert alert-danger" role="alert" style="margin-top: 20px;">Attention, la référence n\'est pas disponible.<br />Veuillez en saisir une nouvelle.</div>';
      $erreur = true;
    } else {
      $message .= '<div class="alert alert-success" role="alert" style="margin-top: 20px;">Votre référence a bien été ajoutée.<br />Félicitation !</div>';
    }

    // Vérification du titre
    $taille_titre = iconv_strlen($titre);
    if($taille_titre < 4 || $taille_titre > 60)
    {
      $message .= '<div class="alert alert-danger" role="alert" style="margin-top: 20px;">Attention, la taille du titre est incorrecte.<br />En effet, le titre doît être compris entre 4 et 14 caractères inclus.</div>';
      $erreur = true; // Si l'on rentre dans cette condition alors il y a une erreur.
    }

    // Vérification si le champ type file n'est pas vide, si l'utilisateur a chargé une image
    if(!empty($_FILES['photo']['name']))
    { 
      // Si ce n'est pas vide alors un fichier a été chargé via le formulaire.

      // On concatène la référence sur le titre afin de ne jamais avoir un fichier avec un nom déjà existant sur le serveur
      $photo_bdd = $reference . $_FILES['photo']['name'];

      // Vérification de l'extension de l'image (extensions acceptées: jpg, jpeg, png, gif)
      $extension = strrchr($_FILES['photo']['name'], '.'); // Cette fonction prédéfinie permet de découper une chaîne selon un caractère fourni en 2ème argument (ici le ".") Attention cette fonction découpera la chaîne à partir de la dernière occurence du 2eme argument (donc nous renvoie la chaîne contenue après le dernier point trouvé)
      // exemple: maphoto.jpg -> on récupère .jpg
      // exemple: maphoto.photo.png -> on récupère .png
      // var_dump(extension);

      // On transforme $extension afin que tous les caractères soient en minuscule
      $extension = strtolower($extension); // Iverse strtoupper()

      // On enlève le "."
      $extension = substr($extension, 1); // 2eme argument, la position de départ, le "." => 0, "j" => 1

      // Les extensions acceptées
      $tab_extension_valide = array("jpg", "jpeg", "png", "gif");

      // Nous pouvons donc vérifier si $extension fait partie des valeurs autorisées dans $tab_extension_valide
      $verif_extension = in_array($extension, $tab_extension_valide);
      // 1er argument dans quoi on cherche, 2eme argument qu'est-ce qu'on cherche
      // in_array() vérifie si une valeur fournie en 1ère argument fait partie des valeurs contenues dans un tableau array fourni en 2eme argument

      if($verif_extension && !$erreur) // si $verif_extension === true et que $erreur !== true (il n'a pas eu d'erreurs au préalable)
      {
        $photo_dossier = ROOT_SERVER . 'photos/' . $photo_bdd;

        copy($_FILES['photo']['tmp_name'], $photo_dossier);
        // copy() permet de copier un fichier depuis un emplacement fourni en premier argument vers un autre emplacement fourni en deuxième argument
      }
      elseif(!$verif_extension) {
        $message .= '<div class="alert alert-danger" role="alert" style="margin-top: 20px;">Attention, votre photo n\'a pas une extension valide.<br />Extensions acceptées: jpg / jpeg / png / gif</div>';
        $erreur = true;
      }

    }

    if($erreur !== true)
    { 
      /************ INSERTION FACTICE ******************/
      // Insertion des données
      /*$ajout = $pdo->prepare("INSERT INTO article (id_article, reference, categorie, titre, description, couleur, taille, sexe, prix, stock) VALUES (NULL, :reference, :categorie, :titre, :description, :couleur, :taille, :sexe, :prix, :stock)");
      $ajout->bindParam(":reference", $reference, PDO::PARAM_STR);
      $ajout->bindParam(":categorie", $categorie, PDO::PARAM_STR);
      $ajout->bindParam(":titre", $titre, PDO::PARAM_STR);
      $ajout->bindParam(":description", $description, PDO::PARAM_STR);
      $ajout->bindParam(":couleur", $couleur, PDO::PARAM_STR);
      $ajout->bindParam(":taille", $taille, PDO::PARAM_STR);
      $ajout->bindParam(":sexe", $sexe, PDO::PARAM_STR);
      $ajout->bindParam(":prix", $prix, PDO::PARAM_STR);
      $ajout->bindParam(":stock", $stock, PDO::PARAM_STR);
      $ajout->execute();*/
      /**************************************************/

      // Insertion des données
      $ajout = $pdo->prepare("INSERT INTO article VALUES (NULL, :reference, :categorie, :titre, :description, :couleur, :taille, :sexe, :photo, :prix, :stock)");
      $ajout->bindParam(":reference", $reference, PDO::PARAM_STR);
      $ajout->bindParam(":categorie", $categorie, PDO::PARAM_STR);
      $ajout->bindParam(":titre", $titre, PDO::PARAM_STR);
      $ajout->bindParam(":description", $description, PDO::PARAM_STR);
      $ajout->bindParam(":couleur", $couleur, PDO::PARAM_STR);
      $ajout->bindParam(":taille", $taille, PDO::PARAM_STR);
      $ajout->bindParam(":sexe", $sexe, PDO::PARAM_STR);
      $ajout->bindParam(":photo", $photo_bdd, PDO::PARAM_STR);
      $ajout->bindParam(":prix", $prix, PDO::PARAM_STR);
      $ajout->bindParam(":stock", $stock, PDO::PARAM_STR);
      $ajout->execute();

      

    }
  }
} else {
  header("location:../connexion.php");
  exit(); // permet d'arrêter l'exécution du script
}



// Les affichages commencent ici, on termine toujours le php par les affichages
require("../inc/header.inc.php");
require("../inc/nav.inc.php");
// echo '<pre>'; print_r($_POST); echo'</pre>';
// Pour afficher les champs en pièces jointes
// echo '<pre>'; print_r($_FILES); echo'</pre>'; // renvoie un tableau multidimensionnel
// echo '<pre>'; print_r($_SERVER); echo'</pre>'; 
?>
    
    <div class="container">

      <div class="starter-template">
        <h1 style="color: DarkGreen;"><span class="glyphicon glyphicon-euro" style="color: DarkGreen; font-size: 30px"></span> Gestion boutique</h1>
        <?= $message; ?>
        <hr />
        <a href="?action=ajout" class="btn btn-warning">Ajouter un produit</a>
        <a href="?action=affichage" class="btn btn-info">Afficher les produits</a>
      </div>  
      
      <?php if(isset($_GET['action']) && $_GET['action'] == 'ajout') { ?>
      <!-- Formulaire -->
      <div class="row">
        <div class="col-sm-4 col-sm-offset-4">
          <!-- Le enctype dans la balise forme est obligatoire lorsqu'on a des fichiers en pièce jointe -->
          
          <form method="post" action="" enctype="multipart/form-data">
            <div class="form-group">        
              <!-- On met les value="" pour laisser les données saisies par l'utilisateur avec du php -->
              <input type="hidden" class="form-control" id="id_article" name="id_article" value="">
            </div>
            <div class="form-group">
              <label for="reference">Référence: <span style="color:red;">*</span></label>
              <input type="text" class="form-control" id="reference" name="reference" value="<?php echo $reference; ?>">
            </div>
            <div class="form-group">
              <label for="categorie">Categorie:</label>
              <select class="form-control" name="categorie" id="categorie">
                <option value="chemise">Chemise</option>
                <!-- Les values ne dépendant pas ici de la bdd, il n'y a pas de champ ENUM et ne sont donc pas obligatoires -->
                <option value="pantalon" <?php if($categorie == "pantalon") { echo 'selected'; } ?>>Pantalon</option>
                <option value="tshirt" <?php if($categorie == "tshirt") { echo 'selected'; } ?>>Tshirt</option>
                <option value="chaussette" <?php if($categorie == "chaussette") { echo 'selected'; } ?>>Chaussette</option>
                <option value="chapeau" <?php if($categorie == "chapeau") { echo 'selected'; } ?>>Chapeau</option>
                <option value="pull" <?php if($categorie == "pull") { echo 'selected'; } ?>>Pull</option>
                <option value="echarpe" <?php if($categorie == "echarpe") { echo 'selected'; } ?>>Echarpe</option>
              </select>
            </div>  
            <div class="form-group">
            <label for="titre">Titre: <span style="color:red;">*</span></label>
              <input type="text" class="form-control" id="titre" name="titre" value="<?php echo $titre; ?>">
            </div>
            <div class="form-group">
            <label for="description">Description:</label>
              <input type="text" class="form-control" id="description" name="description" value="<?php echo $description; ?>">
            </div>
            <div class="form-group">
              <label for="couleur">Couleur:</label>
              <select class="form-control" name="couleur" id="couleur">
                <option value="bleu">Bleu</option>
                <option value="rouge" <?php if($couleur == "rouge") { echo 'selected'; } ?>>Rouge</option>
                <option value="vert" <?php if($couleur == "vert") { echo 'selected'; } ?>>Vert</option>
                <option value="jaune" <?php if($couleur == "jaune") { echo 'selected'; } ?>>Jaune</option>
                <option value="noir" <?php if($couleur == "noir") { echo 'selected'; } ?>>Noir</option>
                <option value="blanc" <?php if($couleur == "blanc") { echo 'selected'; } ?>>Blanc</option>
                <option value="marron" <?php if($couleur == "marron") { echo 'selected'; } ?>>Marron</option>
              </select>
            </div>
            <div class="form-group">
              <label for="taille">Taille:</label>
              <select class="form-control" name="taille" id="taille">
                <option value="xs">XS</option>
                <option value="s" <?php if($taille == "s") { echo 'selected'; } ?>>S</option>
                <option value="m" <?php if($taille == "m") { echo 'selected'; } ?>>M</option>
                <option value="l" <?php if($taille == "l") { echo 'selected'; } ?>>L</option>
                <option value="xl" <?php if($taille == "xl") { echo 'selected'; } ?>>XL</option>
              </select>
            </div>
            <div class="form-group">
              <label for="sexe">Sexe:</label>
              <select class="form-control" name="sexe" id="sexe">
                <option value="m">Homme</option>
                <option value="f" <?php if($sexe == "f") { echo 'selected'; } ?>>Femme</option>
              </select>
            </div>
            <div class="form-group">
            <label for="photo">Photo:</label>
              <input type="file" class="form-control" id="photo" name="photo">
            </div>
            <div class="form-group">
            <label for="prix">Prix:</label>
              <input type="text" class="form-control" id="prix" name="prix" value="<?php echo $prix; ?>">
            </div>
            <div class="form-group">
            <label for="stock">Stock:</label>
              <input type="text" class="form-control" id="stock" name="stock" value="<?php echo $stock; ?>">
            </div>
            <button type="submit" name="validation" id="validation" class="btn btn-primary form-control">Enregistrement</button>
          </form>
        </div> <!-- /.col-sm-4 -->
      </div> <!-- /.row -->
      
        <?php // echo $message; // messages destinés à l'utilisateur ?>
        <!-- Le = est un raccourci de echo, les balises ci dessus et ci dessous sont les mêmes, cela ne fonctionne que pour les echo -->
        
      

    </div><!-- /.container -->
    <?php } // L'accolade correspondante à la condition sur l'affichage du formulaire 
    // if(isset($_GET['action']) && $_GET['action'] == 'ajout')

     if(isset($_GET['action']) && $_GET['action'] == 'affichage')
     { 
     ?>
     <table border="1" style="width: 80%; margin: 0 auto; border-collapse: collapse; text-align: center;">
        <tr>
    <?php 
      $contenu = $pdo->query("SELECT * FROM article");
      $nb_col = $nb_col = $contenu->columnCount();

          for($i = 0; $i < $nb_col; $i++)
          { 
            $colonne = $contenu->getColumnMeta($i);
            echo '<th style="padding: 10px; text-align: center;">' . $colonne['name'] . '</th>';
          }
          while($ligne = $contenu->fetch(PDO::FETCH_ASSOC))
          {
            echo '<tr>';
            // On parcourt grâce à foreach tous les champs de chaque ligne de manière dynamique
              foreach($ligne AS $indice => $info)
              {
                  if($indice == 'photo')
                  {
                     echo '<td style="padding: 10px;"><img src="' . URL . 'photos/' . $info . '" width="100"/></td>';
                  }
                  
                  else {
                    echo '<td style="padding: 10px;">' . substr($info, 0, 30) . '</td>'; 
                  }
                  // On peut aussi faire à la main echo '<td style="padding: 10px;">' . $contenu['id_article'] . '</td>'; soit $contenu['nom_de_la_colonne']
                  // On peut aussi faire à la main echo '<td>' . $contenu['nom'] . '</td>'; 
                  // On peut aussi faire à la main echo '<td>' . $contenu['prenom''] . '</td>';
              }
          }
          
          ?>
        </tr>
     </table>
    <?php
     }
    ?>
<?php
require("../inc/footer.inc.php");