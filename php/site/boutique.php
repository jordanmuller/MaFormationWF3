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

      <!--<ul class="nav nav-tabs">
        <li role="presentation" <?php if(isset($_GET['sexe']) && $_GET['sexe'] == 'femme') { echo 'class="active"'; } ?>><a href="?sexe=femme">Femme</a></li>
        <li role="presentation" <?php if(isset($_GET['sexe']) && $_GET['sexe'] == 'homme') { echo 'class="active"'; } ?>><a href="?sexe=homme">Homme</a></li>
        <li role="presentation" <?php if(isset($_GET['sexe']) && $_GET['sexe'] == 'enfant') { echo 'class="active"'; } ?>><a href="?sexe=enfant">Enfant</a></li>
     </ul>-->

     <div class="row">
        <div class="col-sm-2">
            <?php
                $query = $pdo->query("SELECT DISTINCT categorie FROM article");
            ?>  <ul class="nav nav-pills nav-stacked">
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
                $condition_sql = "";
                if(isset($_GET['categorie']))
                {
                    $condition_sql = "WHERE categorie = '" . $_GET['categorie'] . "'";
                }
                $contenu = $pdo->query("SELECT titre, photo, prix FROM article $condition_sql");
            ?> 
                        <?php
                        echo '<div class="row">';
                        while($ligne = $contenu->fetch(PDO::FETCH_ASSOC))
                        // echo '<pre>'; print_r($ligne); echo '</pre>';
                        {
                            echo '<div class="col-sm-3">';
                            echo '<div class="panel panel-primary">';
                            echo '<div class="panel-heading">' . $ligne['titre'] . '</div>';
                            echo '<div class="panel-body">';
                            echo '<img src="' . URL . 'photos/' . $ligne['photo'] . '" width="100" />' . '<p class="text-right">' . $ligne['prix'] . '</p>';
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

