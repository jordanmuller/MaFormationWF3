<?php
require("inc/init.inc.php");
$erreur = '';

// Si l'indice action existe dans l'URL, et sa valeur est 'vider'
if(isset($_GET['action']) && $_GET['action'] == 'vider')
{
    // Cette condition doit être placé avant creation_panier(), comme cela il est recréé aussitôt
    unset($_SESSION['panier']);
    // Permet de supprimer la partie panier de la session
}

// Retirer un article du panier
if(isset($_GET['action']) && $_GET['action'] == 'retirer' && !empty($_GET['id_article']) && is_numeric($_GET['id_article']))
{
    retirer_article_panier($_GET['id_article']);
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

    ajouter_un_article_au_panier($id_article, $article['prix'], $_POST['quantite'], $article['titre'], $article['photo']);

    //On redirige sur la même page pour perdre les informations dans POST si jamais l'utilisateur actualise la page (F5) l'article ne soit pas rentré une nouvelle fois 
    header("location:panier.php");
}






// VALIDATION DU PAIEMENT DU PANIER
if(isset($_GET['action']) && $_GET['action'] == 'payer' && !empty($_SESSION['panier']['prix']))
{
    // Si l'utilisateur clique sur le bouton "payer le panier"
    // 1ere action vérification du stock disponible en comparaison des quantités demandées pour UN SEUL ARTICLE A LA FOIS grâce à $i

    for($i = 0; $i < count($_SESSION['panier']['id_article']); $i++)
    {
       
        // On parcourt la table article pour les id correspondants
        $resultat = $pdo->query("SELECT * FROM article WHERE id_article = " . $_SESSION['panier']['id_article'][$i]);
        $verif_stock = $resultat->fetch(PDO::FETCH_ASSOC);

        // Si on entre dans cette condition alors il y a un stock inférieur à la quantité demandée
        if($verif_stock['stock'] < $_SESSION['panier']['quantite'][$i])
        {
            // 2 possibilités: stock à 0 ou stock > 0 mais inférieur à la quantité
            if($verif_stock['stock'] > 0)
            {
                $message .= '<div class="alert alert-danger" role="alert" style="margin-top: 20px;">"Attention, la quantité de l\'article: "' . $_SESSION['panier']['titre'][$i] . '" a été modifiée car notre stock est insuffisant ! <br /> Veuillez vérifier votre commande.</div>';
                // Il reste du stock alors on affecte directement le stock restant pour la quantité demandée
                $_SESSION['panier']['quantite'][$i] = $verif_stock['stock'];

            }
            else {
                $message .= '<div class="alert alert-danger" role="alert" style="margin-top: 20px;">"Attention, l\'article: "' . $_SESSION['panier']['titre'][$i] . '" a été supprimé de votre panier, car nous sommes en rupture de stock de ce produit ! <br /> Veuillez vérifier votre commande.</div>';
                // Si le stock est à 0 alors on enlève l'article du panier
                retirer_article_panier($_SESSION['panier']['id_article'][$i]);
                // Si nous enlevons un article du panier, il est nécessaire de décrémenter (-1) la variable $i car avec array_splice() sur function.inc.php, les indices sont réordonnées. On risquerait donc d'en zapper un' 
                $i--;
            }
            $erreur = true;
        }

    }

    if(!$erreur) // ou if($erreur !== true)
    {
        $id_membre = $_SESSION['utilisateur']['id_membre'];
        $montant_commande = montant_total();

        // Quand on fait une action, on n'est pas obligés de placer le résultat dans une variable
        $pdo->query("INSERT INTO commande (id_membre, montant, date) VALUES ($id_membre, $montant_commande, NOW())");
        $id_commande = $pdo->lastInsertId(); // On récupère l'id inséré
        $nb_tout_panier = count($_SESSION['panier']['titre']);
        // On parcourt le panier avant le paiement
        for($i = 0; $i < $nb_tout_panier; $i++)
        {
            // On prépare les nouvelles valeurs pour les insérer dans la table commande
            $id_article_commande = $_SESSION['panier']['id_article'][$i];
            $quantite_commande = $_SESSION['panier']['quantite'][$i];
            $prix_commande = $_SESSION['panier']['prix'][$i];
            $pdo->query("INSERT INTO details_commande (id_commande, id_article, quantite, prix) VALUES ($id_commande, $id_article_commande, $quantite_commande, $prix_commande)");

            // Mise à jour du stock suite au paiement
            $pdo->query("UPDATE article SET stock = stock - $quantite_commande WHERE id_article = $id_article_commande");
        }
        unset($_SESSION['panier']);
    }
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
                        <!-- On fusionne 6 colonnes avec colspan -->
                        <th colspan="7" class="text-center">Panier</th>
                    </tr>
                    <tr>
                        <th class="text-center">Article</th>
                        <th class="text-center">Titre</th>
                        <th class="text-center">Quantité</th>
                        <th class="text-center">Prix unitaire</th>
                        <th class="text-center">Prix total</th>
                        <th class="text-center">Photo</th>
                        <th class="text-center">Retirer</th>
                    </tr>
                    <?php
                        // Vérification si le panier est vide, on peut vérifier sur n'importe quel indice comme ['titre'], n'importe quel tableau array du dernier niveau (titre, prix, id_article, quantité)
                        if(empty($_SESSION['panier']['id_article']))
                        {
                            echo '<tr><th colspan="7" class="text-center" style="color: FireBrick;">Aucun article dans votre panier</th></tr>';
                        } else {
                            // Sinon on affiche tous les produits dans un tableau HTML
                            $taille_panier = count($_SESSION['panier']['titre']);
                            
                            $prix_total = "";
                            for($i = 0; $i < $taille_panier; $i++)
                            {
                                echo '<tr>';  //Au lieu d'écrire des echo, on écrit tout en haut en concaténant dans $tab .= '<tr>' à la place de CHAQUE echo ! 
                                    echo '<td>' . $_SESSION['panier']['id_article'][$i] . '</td>';
                                    echo '<td>' . $_SESSION['panier']['titre'][$i] . '</td>';
                                    echo '<td>' . $_SESSION['panier']['quantite'][$i] . '</td>';
                                    echo '<td>' . $_SESSION['panier']['prix'][$i] . ' €</td>';
                                    $prix_total = $_SESSION['panier']['prix'][$i] * $_SESSION['panier']['quantite'][$i];
                                    echo '<td>' . $prix_total . ' €</td>';
                                    echo '<td><img src="' . URL . 'photos/' . $_SESSION['panier']['photo'][$i] . '" width="30" /></td>';
                                    echo '<td><a href="?action=retirer&id_article=' . $_SESSION['panier']['id_article'][$i] . '" class="btn btn-warning"><span class="glyphicon glyphicon-trash"></span> Retirer</a></td>';
                                echo '</tr>';
                            }
                          
                            
                            // Rajouter une ligne du tableau pour payer le panier si l'utilisateur est connecté, sinon afficher un texte pour proposer à l'utilisateur de se connecter
                            if(isset($_SESSION['utilisateur'])) // On aurait pu utiliser la fonction if(utilisateur_est_connecte())
                            { 
                                echo '<tr><td colspan="7"><a href="?action=payer" class="btn btn-primary">Payer le panier</a></td></tr>';
                            } else {
                                echo '<tr><td colspan="7">Veulliez vous <a href="inscription.php">inscrire</a> ou vous <a href="connexion.php">connecter</a> pour payer votre panier </td></tr>';
                            }

                            // Rajouter une ligne au tableau qui affiche un bouton vider le panier uniquement si le panier n'est pas vide, faire le traitement afin que si on clique sur ce bouton, il faut vider le panier
                            if(!empty($_SESSION['panier']['id_article']))
                            {
                                echo '<tr><td colspan="7"><a href="?action=vider" class="btn btn-danger">Vider le panier</a></td></tr>';
                            }
                            // Rajouter une ligne pour afficher le prix total du panier
                            $total = number_format(montant_total(), 2);
                            $total = str_replace(',', ' ', $total);
                            $total = str_replace('.', ',', $total);
                            echo '<tr><td colspan="7">Prix total de votre commande: <b>' . $total . ' €</b></td></tr>';


                        }
                    ?>
                </table>
                <hr />
                <p>Règlement par chèque uniquement ! <br />A l'adresse: 18 rue Geoffroy L'Asnier 75004 Paris</p>
                <hr />
                <p>
                <?php
                if(utilisateur_est_connecte())
                {
                    // Si l'utilisateur est connecté, on affiche son adresse de livraison
                    echo '<address><b>Votre adresse de livraison est: </b><br />' . $_SESSION['utilisateur']['adresse'] . '<br />' . $_SESSION['utilisateur']['cp'] . '<br />' . $_SESSION['utilisateur']['ville'] . '</address>';
                } else {
                    echo '<tr><td colspan="4">Veulliez vous <a href="inscription.php">inscrire</a> ou vous <a href="connexion.php">connecter</a> pour afficher vos coordonnées </td></tr>';
                }

                ?>
                </p>
            </div>
        </div>
        <?php


            

        ?>

    </div><!-- /.container -->
<?php
require("inc/footer.inc.php");