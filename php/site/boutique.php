<?php
require("inc/init.inc.php");








// Les affichages commencent ici, on termine toujours le php par les affichages
require("inc/header.inc.php");
require("inc/nav.inc.php");
?>
    
    <div class="container">

      <div class="starter-template">
        <h1 style="color: darkred;"><span class="glyphicon glyphicon-gift"></span> Ma Boutique</h1>
      </div>  

      <?php
        $requete = $pdo->query("SELECT DISTINCT sexe FROM article");
      ?>
        <ul class="nav nav-tabs">
     <?php
        while($ligne = $requete->fetch(PDO::FETCH_ASSOC))
        {

            foreach($ligne AS $sexe)
            {
                if ($ligne['sexe'] == 'm')
                {
                    $homme = 'Homme'; 
                    echo '<li role="presentation"><a href="?sexe=' . $sexe . '">' . $homme . '</a></li>';
                } else {
                    $femme = 'Femme';
                    echo '<li role="presentation"><a href="?sexe=' . $sexe . '">' . $femme . '</a></li>';
                }

                
            }
        }
     ?>
     </ul>

     <div class="row">
        <div class="col-sm-2">
            <?php
                $query = $pdo->query("SELECT DISTINCT categorie FROM article");
            ?>  
                
                <!-- Récupérer toutes les catégories en BDD et les afficher dans une liste ul li sous forme de liens a href avec une information GET par exemple : ?categorie=pantalon -->
                <ul class="nav nav-pills nav-stacked">
                <li role="presentation"><a href="boutique.php">Tous les articles</a></li>
            <?php
                while($affichage = $query->fetch(PDO::FETCH_ASSOC))
                { 
                    foreach($affichage AS $categorie)
                    // echo '<pre>'; print_r($affichage); echo '</pre>';
                    echo '<li role="presentation"><a href="?categorie=' . $categorie . '">' . $categorie . '</a></li>';
                }
           ?>     
                </ul>

            
        </div>
        <div class="col-sm-10">
            <?php
                /*$condition_sql = "";
                if(!empty($_GET['categorie']))
                {
                    // Equivalent à WHERE categorie = 'categorie';
                    $condition_sql = "WHERE categorie = '" . $_GET['categorie'] . "'";
                }*/
                
                if(empty($_GET['categorie']))
                { 
                    $contenu = $pdo->query("SELECT * FROM article");
                }
                else {
                    $cat = $_GET['categorie'];
                    $contenu = $pdo->prepare("SELECT * FROM article WHERE categorie = :categorie");
                    $contenu->bindParam(":categorie", $cat, PDO::PARAM_STR);
                    $contenu->execute();
                }

                if(empty($_GET['sexe']))
                { 
                    $contenu = $pdo->query("SELECT * FROM article");
                }
                else {
                    $sexe = $_GET['sexe'];
                    $contenu = $pdo->prepare("SELECT * FROM article WHERE sexe = :sexe");
                    $contenu->bindParam(":sexe", $sexe, PDO::PARAM_STR);
                    $contenu->execute();
                }
                
            ?> 
                        <?php
                        echo '<div class="row">';
                        $compteur = 0;
                        while($ligne = $contenu->fetch(PDO::FETCH_ASSOC))
                        // echo '<pre>'; print_r($ligne); echo '</pre>';
                        {
                        //    Afin de ne pas avoir de souci avec le float, on ferme et on ouvre une ligne bootstrap (class="row") pour gérer les liens d'affichage
                            if($compteur%4 == 0 && !$compteur != 0) { echo '<div class="row">'; }
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

