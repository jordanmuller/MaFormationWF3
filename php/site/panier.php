<?php
require("inc/init.inc.php");

// Si l'indice action existe dans l'URL, et sa valeur est 'vider'
if(isset($_GET['action']) && $_GET['action'] == 'vider')
{
    unset($_SESSION['panier']);
}


// Création du panier
creation_panier();

if(isset($_POST['ajout_panier']))
{
    $id_article = $_POST['id_article'];
    // Si l'indice existe dans $_POST, alors l'utilisateur a cliqué sur le bouton ajouter au panier (depuis la page fiche_article.php)
    $info_article = $pdo->prepare("SELECT * FROM article WHERE id_article = :id_article");
    $info_article->bindParam(":id_article", $id_article, PDO::PARAM_STR);
    $info_article->execute();

    $article = $info_article->fetch(PDO::FETCH_ASSOC);
    
    // Ajout de la TVA sur le prix
    $article['prix'] = $article['prix'] * 1.2;

    ajouter_un_article_au_panier($id_article, $article['prix'], $_POST['quantite'], $article['titre']);

    //On redirige sur la même page pour perdre les informations dans POST si jamais l'utilisateur actualise la page (F5) l'article ne soit pas rentré une nouvelle fois 
    header("location:panier.php");
}







// Les affichages commencent ici, on termine toujours le php par les affichages
require("inc/header.inc.php");
require("inc/nav.inc.php");
// echo '<pre>'; print_r($_SESSION); echo '</pre>';
// echo '<pre>'; print_r($_POST); echo '</pre>';
?>
    
    <div class="container">

      <div class="starter-template">
        <h1><span class="glyphicon glyphicon-shopping-cart" style="color: Indigo;"></span> Panier</h1>
      </div>  
        <?php // echo $message; // messages destinés à l'utilisateur ?>
        <!-- Le = est un raccourci de echo, les balises ci dessus et ci dessous sont les mêmes, cela ne fonctionne que pour les echo -->
        <?= $message; ?>
        
        <div class="row">
            <div class="col-sm-8 col-sm-offset-2">
                <table class="table table-bordered text-center">
                    <tr>
                        <!-- On fusionne 4 colonnes avec colspan -->
                        <th colspan="4" class="text-center">Panier</th>
                    </tr>
                    <tr>
                        <th class="text-center">Article</th>
                        <th class="text-center">Titre</th>
                        <th class="text-center">Quantité</th>
                        <th class="text-center">Prix unitaire</th>
                    </tr>
                    <?php
                        // Vérification si le panier est vide, on peut vérifier sur n'importe quel indice comme ['titre'], n'importe quel tableau array du dernier niveau (titre, prix, id_article, quantité)
                        if(empty($_SESSION['panier']['id_article']))
                        {
                            echo '<tr><th colspan="4" class="text-center" style="color: FireBrick;">Aucun article dans votre panier</th></tr>';
                        } else {
                            // Sinon on affiche tous les produits dans un tableau HTML
                            $taille_panier = count($_SESSION['panier']['titre']);
                            
                            $prix_total = "";
                            for($i = 0; $i < $taille_panier; $i++)
                            {
                                echo '<tr>';
                                    echo '<td>' . $_SESSION['panier']['id_article'][$i];
                                    echo '<td>' . $_SESSION['panier']['titre'][$i];
                                    echo '<td>' . $_SESSION['panier']['quantite'][$i];
                                    echo '<td>' . $_SESSION['panier']['prix'][$i];
                                    $prix_total += $_SESSION['panier']['prix'][$i] * $_SESSION['panier']['quantite'][$i];
                                echo '</tr>';
                            }
                            
                            // Rajouter une ligne du tableau pour payer le panier si l'utilisateur est connecté, sinon afficher un texte pour proposer à l'utilisateur de se connecter
                            if(isset($_SESSION['utilisateur']))
                            { 
                                echo '<tr><td colspan="4"><a href="?action=payer" class="btn btn-primary">Payer le panier</a></td></tr>';
                            } else {
                                echo '<tr><td colspan="4">Veulliez vous <a href="inscription.php">inscrire</a> ou vous <a href="connexion.php">connecter</a> pour payer votre panier </td></tr>';
                            }

                            // Rajouter une ligne au tableau qui affiche un bouton vider le panier uniquement si le panier n'est pas vide, faire le traitement afin que si on clique sur ce bouton, il faut vider le panier
                            if(!empty($_SESSION['panier']['id_article']))
                            {
                                echo '<tr><td colspan="4"><a href="?action=vider" class="btn btn-danger">Vider le panier</a></td></tr>';
                            }
                            // Rajouter une ligne pour afficher le prix total du panier
                            echo '<tr><td colspan="4">Prix total de votre commande: ' . $prix_total . ' €</td></tr>';
                        }
                    ?>
                </table>
            </div>
        </div>
        <?php


            

        ?>

    </div><!-- /.container -->
<?php
require("inc/footer.inc.php");