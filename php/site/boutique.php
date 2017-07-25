<?php
require("inc/init.inc.php");
echo '<pre>'; var_dump($_SESSION); echo '</pre>';
$contenu = $pdo->query("SELECT * FROM article");

// Requête de récupération de tous les produits
if($_POST) // Equivaut à if(!empty($_POST))
{
    $condition = "";
    $arg_couleur = false;
    $arg_taille = false;
    // Si l'indice couleur existe
    if(!empty($_POST['couleur']))
    {
        $condition .= " WHERE couleur = :couleur ";
        $arg_couleur = true;
        $filtre_couleur = $_POST['couleur'];

        /*$contenu = $pdo->prepare("SELECT * FROM article WHERE couleur = :couleur");
        $contenu->bindParam(":couleur", $filtre_couleur, PDO::PARAM_STR);
        $contenu->execute();*/
    }
    if(!empty($_POST['taille']))
    {
        if($arg_couleur)
        {
            $condition .= " AND taille = :taille ";
        }
        else {
            $condition .= " WHERE taille = :taille ";
        }
        
        $arg_taille = true;
        $filtre_taille = $_POST['taille'];

    }
    $contenu = $pdo->prepare("SELECT * FROM article $condition");
    if($arg_couleur) //Si $arg_couleur == true alors il faut fournir l'argument couleur
    {
        $contenu->bindParam(":couleur", $filtre_couleur, PDO::PARAM_STR);
    }
    if($arg_taille) 
    {
        $contenu->bindParam(":taille", $filtre_taille, PDO::PARAM_STR);
    }
    $contenu->execute();
}

elseif(!empty($_GET['categorie']))
{ 
    $filtre_categorie = $_GET['categorie'];
    $contenu = $pdo->prepare("SELECT * FROM article WHERE categorie = :categorie");
    $contenu->bindParam(":categorie", $filtre_categorie, PDO::PARAM_STR);
    $contenu->execute();
}

// Requete de récupération des différentes catégories en bdd
$liste_categorie = $pdo->query("SELECT DISTINCT categorie FROM article");

// Requête de récupération des différentes couleurs en bbd
$liste_couleur = $pdo->query("SELECT DISTINCT couleur FROM article ORDER BY couleur");

// Requête de récupération des différentes tailles en bbd
$liste_taille = $pdo->query("SELECT DISTINCT taille FROM article ORDER BY taille");






// Les affichages commencent ici, on termine toujours le php par les affichages
require("inc/header.inc.php");
require("inc/nav.inc.php");
echo '<pre>'; print_r($_POST); echo '</pre>';
?>
    
    <div class="container">

      <div class="starter-template">
        <h1 style="color: darkred;"><span class="glyphicon glyphicon-gift"></span> Ma Boutique</h1>
        
      </div>  


     <div class="row">
        <div class="col-sm-2">
            <?php
                
                
            ?>  
                
                <!-- Récupérer toutes les catégories en BDD et les afficher dans une liste ul li sous forme de liens a href avec une information GET par exemple : ?categorie=pantalon -->
                <ul class="nav nav-pills nav-stacked">
                <li role="presentation"><a href="boutique.php">Tous les articles</a></li>
            <?php
                while($categorie = $liste_categorie->fetch(PDO::FETCH_ASSOC))
                { 
                    // echo '<pre>'; print_r($categorie); echo '</pre>';
                    // echo '<pre>'; print_r($affichage); echo '</pre>';
                    echo '<li role="presentation"><a href="?categorie=' . $categorie['categorie'] . '">' . $categorie['categorie'] . '</a></li>';
                }
                    echo '</ul>';
                    echo '<hr />';
                    echo '<form method="post" action="">';
                    
                    // Affichage couleur
                    echo '<div class="form-group">';                    
                    echo '<label for="couleur">Couleur</label>';
                    echo '<select name="couleur" id="couleur" class="form-control">';  
                    echo '<option></option>';                 
                    while($couleur = $liste_couleur->fetch(PDO::FETCH_ASSOC))
                    {                    
                            echo '<option>' . $couleur['couleur'] . '</option>';   
                    }
                    echo '</select></div>';

                    // Affichage taille
                    echo '<div class="form-group">';
                    echo '<label for="taille">Taille</label>';
                    echo '<select name="taille" id="taille" class="form-control">';
                    echo '<option></option>';
                    while($taille = $liste_taille->fetch(PDO::FETCH_ASSOC))
                    {            
                            echo '<option>' . $taille['taille'] . '</option>';   
                    }
                    echo '</select></div>';
                    echo '<div class="form-group">';
                    echo '<button type="submit" name="filtrer" id="filtrer class="form-control btn btn-primary">Valider</button></div>';
                    echo '</form>';
                
           ?>     
             

            
        </div>
        <div class="col-sm-10">
            <?php
                /*$condition_sql = "";
                if(!empty($_GET['categorie']))
                {
                    // Equivalent à WHERE categorie = 'categorie';
                    $condition_sql = "WHERE categorie = '" . $_GET['categorie'] . "'";
                }*/
                


                
            ?> 
                    <?php
                    echo '<div class="row">';
                    $compteur = 0;
                    while($ligne = $contenu->fetch(PDO::FETCH_ASSOC))
                    // echo '<pre>'; print_r($ligne); echo '</pre>';
                    {
                    //    Afin de ne pas avoir de souci avec le float, on ferme et on ouvre une ligne bootstrap (class="row") pour gérer les liens d'affichage
                        if($compteur%4 == 0 && $compteur != 0) { echo '<div class="row">'; }
                        $compteur++;
                        echo '<div class="col-sm-3">';
                        echo '<div class="panel panel-primary">';
                        echo '<div class="panel-heading" style="text-align: center;">' . $ligne['titre'] . '</div>';
                        echo '<div class="panel-body">';
                        echo '<img src="' . URL . 'photos/' . $ligne['photo'] . '" class="img-responsive" />' . '<p class="text-center"><b>' . $ligne['prix'] . ' €</b></p>';
                        echo '<hr />';
                        echo '<a href="fiche_article.php?id_article=' . $ligne['id_article'] . '" class="btn btn-primary">Voir la fiche article</a>';
                        echo '</div></div></div>';
                    }
                    echo '</div>';
                        ?>


        </div> <!-- /. sm-10 -->
     </div> <!-- /.row -->

        <?php // echo $message; // messages destinés à l'utilisateur ?>
        <!-- Le = est un raccourci de echo, les balises ci dessus et ci dessous sont les mêmes, cela ne fonctionne que pour les echo -->
        <?= $message; ?>
      

    </div><!-- /.container -->
<?php
require("inc/footer.inc.php");

