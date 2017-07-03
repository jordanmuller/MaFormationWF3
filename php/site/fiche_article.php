<?php
require("inc/init.inc.php");

// Si id_article dans l'URL n'existe pas ou est vide
if(empty($_GET['id_article']) || !is_numeric($_GET['id_article']))
{
    header("location:boutique.php");
} 
    
$id_article = $_GET['id_article']; 
$fiche = $pdo->prepare("SELECT * FROM article WHERE id_article = :id_article");
$fiche->bindParam(":id_article", $id_article, PDO::PARAM_STR);
$fiche->execute();

// Vérification si l'on a bien récupéré un article ou si nous avons une réponse vide (exemple changement d'id_article dans l'utilisateur)
if($fiche->rowCount() < 1)
{
    // S'il y a moins d'une ligne
    header("location:boutique.php");
}

$article = $fiche->fetch(PDO::FETCH_ASSOC);

if($article['sexe'] == 'm')
{
    $sexe = 'Masculin';
} else {
    $sexe = 'Féminin';
}


// Les affichages commencent ici, on termine toujours le php par les affichages
require("inc/header.inc.php");
require("inc/nav.inc.php");
// echo '<pre>'; print_r($article); echo'</pre>';

?>
    
    <div class="container">

      <div class="starter-template">
        <h1><span class="glyphicon glyphicon-tags" style="color: NavajoWhite"></span> Fiches Articles</h1>
      </div>  
        <?php // echo $message; // messages destinés à l'utilisateur ?>
        <!-- Le = est un raccourci de echo, les balises ci dessus et ci dessous sont les mêmes, cela ne fonctionne que pour les echo -->
        <?= $message; ?>

        <div class="row">

            <div class="col-sm-12">
                <?php
                    echo '<div class="panel panel-success">';
                    echo '<div class="panel-heading">';
                    echo '<h2 class="panel-title" style="text-align: center; font-size: 22px;">Fiche de l\'article</h2>';
                    echo '</div>';    
                    echo '<div class="panel-body">';
                        foreach($article AS $indice => $info)
                        {
                            if($indice != 'id_article' && $indice != 'stock' && $indice != 'photo')
                            {
                                echo '<p>' . $info . '</p><hr />';
                            }
                            elseif($indice == 'photo')
                            {
                                echo '<p>' . $indice . ': <img src="' . URL . 'photos/' . $info . '" width="100" /></p>';
                            } 
                        }
                        echo '<hr />';


                        // On affiche le formulaire d'ajout au panier que si le stock est supérieur à zéro
                        if($article['stock'] > 0)
                        { 
                            // Formulaire d'ajout au panier
                            echo '<form method="post" action="panier.php">';

                            // On récupère l'id_article dans un champ caché afin de savoir ensuite quel est le produit qui a été ajouté au panier
                            echo '<input type="hidden" name="id_article" value="' . $article['id_article'] .'">';

                            // Faire un champ select pour le choix de la quantité selon la quantité du produit
                            echo '<select name="quantite" class="form-control">';

                            // On peut faire des boucles avec plusieurs conditions d'entrée, comme les conditions standards
                            for ($i = 1; $i <= $article['stock'] && $i <= 7; $i++)
                            {
                                echo '<option>' . $i . '</option>';
                            }
                            echo '</select><br />';

                            echo '<input type="submit" name="ajout_panier" value="Ajouter au panier" class="form-control btn btn-success" />';

                            echo '</form>';
                        } else {
                            echo '<h3>Rupture de stock pour ce produit.</h3>';
                        }
                        echo '<hr />';
                        echo '<a href="boutique.php?categorie=' . $article['categorie'] . '" class="btn btn-warning form-control">Retour vers votre séléction</a>';
                    echo '</div>';
                    echo '</div>';
                ?>
            </div>
        </div>
      

    </div><!-- /.container -->
<?php
require("inc/footer.inc.php");