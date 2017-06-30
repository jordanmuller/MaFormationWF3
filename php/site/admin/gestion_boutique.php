<?php
require("../inc/init.inc.php");

// Si l'utilisateur est connecté en admin
if(utilisateur_connecte_admin())
{

  // Mettre en place un contrôle pour savoir si l'utilisateur veut une suppression d'un produit
  // Savoir si l'indice action et l'indice id_article existent
  if(isset($_GET['action']) && $_GET['action'] == 'supprimer' && !empty($_GET['id_article']) && is_numeric($_GET['id_article']))
  // is_numeric renvoie si $_GET['id_article'] est un nombre ex: 42 ou une CHAINE NUMERIQUE ex "42" entre double quotes, avec is_numeric() on rentre dedans même si c'est de type string, avec $_GET ou $_POST par exemple
  {
    // On fait une requête pour récupérer les informations de l'article afin de connaître la photo à supprimer
    $id_article = $_GET['id_article'];
    $article_a_supprimer = $pdo->prepare("SELECT * FROM article WHERE id_article = :id_article");
    $article_a_supprimer->bindParam(":id_article", $id_article, PDO::PARAM_STR);
    $article_a_supprimer->execute();
    
    // Je ne récupère qu'une seule ligne car les id_article sont uniques, donc pas de boucle
    $suppression_article = $article_a_supprimer->fetch(PDO::FETCH_ASSOC);
    
    // Si l'indice photo de la requete effectuée n'est pas vide (il y a donc une photo)
    if(!empty($suppression_article['photo']))
    {
      // On vérifie le chemin si le fichier existe
      $chemin_photo = ROOT_SERVER . 'photos/' . $suppression_article['photo'];
      // $message .= $chemin_photo;

      // On vérifie si la photo ou un fichier existe dans le chemin donné
      if(file_exists($chemin_photo))
      {
        unlink($chemin_photo); // unlink() permet de supprimer un fichier sur le serveur
      }
    }
    $suppression = $pdo->prepare("DELETE FROM article WHERE id_article = :id_article");
    $suppression->bindParam(":id_article", $id_article, PDO::PARAM_STR);
    $suppression->execute();
    $message .= '<div class="alert alert-success" role="alert" style="margin-top: 20px;">L\'article numéro ' . $id_article . ' a bien été supprimé</div>';

    // On bascule sur l'affiche du tableau
    $_GET['action'] = 'affichage';

    // $message .= '<div class="alert alert-danger" role="alert" style="margin-top: 20px;">Voulez vous vraiment supprimer cette ligne ?</div>';
  }

  // Déclaration de variables vides pour affichage dans les values du formulaire
  $id_article;
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
  /******************************************************/
  // RECUPERATION DES INFORMATIONS D'UN ARTICLE A MODIFIER
  /******************************************************/
  if(isset($_GET['action']) && $_GET['action'] == 'modifier' && !empty($_GET['id_article']) && is_numeric($_GET['id_article']))
  {
    // On fait une requête pour récupérer les informations de l'article afin de connaître la photo à modifier
    $id_article = $_GET['id_article'];
    $article_a_modifier = $pdo->prepare("SELECT * FROM article WHERE id_article = :id_article");
    $article_a_modifier->bindParam(":id_article", $id_article, PDO::PARAM_STR);
    $article_a_modifier->execute();

    $article_actuel = $article_a_modifier->fetch(PDO::FETCH_ASSOC);
    
    $id_article = $article_actuel['id_article'];
    $reference = $article_actuel['reference'];
    $categorie = $article_actuel['categorie'];
    $titre = $article_actuel['titre'];
    $description = $article_actuel['description'];
    $couleur = $article_actuel['couleur'];
    $taille = $article_actuel['taille'];
    $sexe = $article_actuel['sexe'];
    $prix = $article_actuel['prix'];
    $stock = $article_actuel['stock'];
    // On récupère la photo de l'article dans une nouvelle variable, c'est une variable intermédiaire affichant la photo enregistrée lors de l'insertion de données, si la photo est modifiée on remettra sa valeur dans $photo_bdd
    $photo_actuelle = $article_actuel['photo'];

  }

  // Vérification de l'existence des champs du formulaire
  if(isset($_POST['reference']) && isset($_POST['categorie']) && isset($_POST['titre']) && isset($_POST['description']) && isset($_POST['couleur']) && isset($_POST['taille']) && isset($_POST['sexe']) && isset($_FILES['photo']) && isset($_POST['prix']) && isset($_POST['stock']))
  {
    $id_article = $_POST['id_article'];
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

    // Contrôle sur la disponibilité de la référence en BDD si on est dans le cas d'un ajoutn car lors de la modif la référence existera toujours
    $verif_ref = $pdo->prepare("SELECT * FROM article WHERE reference = :reference");
    $verif_ref->bindParam(":reference", $reference, PDO::PARAM_STR);
    $verif_ref->execute();

    if($verif_ref->rowCount() > 0 && isset($_GET['action']) && $_GET['action'] == 'ajout')
    {
      $message .= '<div class="alert alert-danger" role="alert" style="margin-top: 20px;">Attention, la référence n\'est pas disponible.<br />Veuillez en saisir une nouvelle.</div>';
      $erreur = true;
    } else {
      // $message .= '<div class="alert alert-success" role="alert" style="margin-top: 20px;">Votre référence a bien été ajoutée.<br />Félicitation !</div>';
    }

    // Vérification du titre
    $taille_titre = iconv_strlen($titre);
    if($taille_titre < 4 || $taille_titre > 60)
    {
      $message .= '<div class="alert alert-danger" role="alert" style="margin-top: 20px;">Attention, la taille du titre est incorrecte.<br />En effet, le titre doît être compris entre 4 et 14 caractères inclus.</div>';
      $erreur = true; // Si l'on rentre dans cette condition alors il y a une erreur.
    }

    // On récupère l'ancienne photo ($photo_actuelle) dans le cas d'une modification
    if(isset($_GET['action']) && $_GET['action'] == 'modifier')
    {
      // C'est le nom du champ input type="hidden"
      if(isset($_POST['ancienne_photo']))
      {
        $photo_bdd = $_POST['ancienne_photo'];
      }
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

    if($erreur !== true) // équivaut à if(!$erreur) sauf que c'est une "==" et non "==="
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
      if(isset($_GET['action']) && $_GET['action'] == 'ajout')
      { 
        $ajout = $pdo->prepare("INSERT INTO article VALUES (NULL, :reference, :categorie, :titre, :description, :couleur, :taille, :sexe, :photo, :prix, :stock)");
      }
      elseif(isset($_GET['action']) && $_GET['action'] == 'modifier') {
        $ajout = $pdo->prepare("UPDATE article SET reference = :reference, categorie = :categorie, titre = :titre, description = :description, couleur = :couleur, taille = :taille, sexe = :sexe, photo = :photo, prix = :prix, stock = :stock WHERE id_article = :id_article");
        $id_article = $_POST['id_article'];
        // On ne lie le marqueur nominatif :id_article à la valeur récupéré $_POST que dans cette condition où $_GET['action'] == 'modifier'
        $ajout->bindParam(":id_article", $id_article, PDO::PARAM_STR);
      }

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
      
      <?php if(isset($_GET['action']) && ($_GET['action'] == 'ajout' || $_GET['action'] == 'modifier')) { ?>
      <!-- Formulaire -->
      <div class="row">
        <div class="col-sm-4 col-sm-offset-4">
          <!-- Le enctype dans la balise forme est obligatoire lorsqu'on a des fichiers en pièce jointe -->
          
          <form method="post" action="" enctype="multipart/form-data">
            <div class="form-group">        
              <!-- On met les value="" pour laisser les données saisies par l'utilisateur avec du php -->
              <input type="hidden" class="form-control" id="id_article" name="id_article" value="<?php echo $id_article; ?>">
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

            <?php
              // Affiche la photo actuelle dans le cas d'une modification
              if(isset($article_actuel)) // Si cette variable existe, alors nous sommes dans le cas d'une modification
              {
                echo '<div class="form-group">';
                echo '<label>Photo actuelle:</label>';
                echo '<img src="' . URL . 'photos/' . $photo_actuelle . '" class="img-thumbnail" width="210" />';
                // On crée un champ caché qui contient le nom de la photo afin de le récupérer lors de la validation du formulaire
                echo '<input type="hidden" name="ancienne_photo" value="' . $photo_actuelle . '" />';
                echo '</div>';
              }
            ?>

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
     <div class="row">
      <div class="col-sm-12">
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
              echo '<th style="padding: 10px; text-align: center;">' . 'Modifier' .'</th>';
              echo '<th style="padding: 10px; text-align: center;">' . 'Supprimer' .'</th>';
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
                      
                      elseif ($indice == 'description') {
                        echo '<td style="padding: 10px;">' . substr($info, 0, 40) . '</td>'; 
                      }
                      elseif ($indice == 'prix') {
                        echo '<td style="padding: 10px;"><span style="color: red;">' . $info . '€' . '</span></td>';
                      }
                
                      else {
                        echo '<td style="padding: 10px;">' . $info . '</td>';
                      }
                      
                      // On peut aussi faire à la main echo '<td style="padding: 10px;">' . $contenu['id_article'] . '</td>'; soit $contenu['nom_de_la_colonne']
                      // On peut aussi faire à la main echo '<td>' . $contenu['nom'] . '</td>'; 
                      // On peut aussi faire à la main echo '<td>' . $contenu['prenom''] . '</td>';
                  }
                  // La supervariable $_GET de type array obtient les indices ['action'] et ['id_article']
                  echo '<td><a href="?action=modifier&id_article=' . $ligne['id_article'] . '" class="btn btn-warning"><span class="glyphicon glyphicon-pencil" style="font-size: 30px;"></span></a></td>';
                  echo '<td><a onclick="return(confirm(\'Etes-vous sûr ?\'))" href="?action=supprimer&id_article=' . $ligne['id_article'] . '" class="btn btn-danger"><span class="glyphicon glyphicon-trash" style="font-size: 30px;"></span></a></td>';
              }
              
              ?>
            </tr>
        </table>
        </div> <!-- /.col-sm-12 -->
      </div> <!-- /.row -->
    <?php
     }
    ?>
<?php
require("../inc/footer.inc.php");