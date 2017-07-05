<?php
require("../inc/init.inc.php");

if(!utilisateur_connecte_admin())
{
  header("location:../connexion.php");
  exit(); // permet d'arrêter l'exécution du script
}

if(isset($_GET['action']) && $_GET['action'] == 'detail' && isset($_GET['id_commande']) && is_numeric($_GET['id_commande']))
{
  $id_commande = $_GET['id_commande'];
  $detail = $pdo->prepare("SELECT * FROM details_commande dc, article a, membre m, commande c WHERE dc.id_commande = :id_commande AND dc.id_commande = c.id_commande AND dc.id_article = a.id_article AND c.id_membre = m.id_membre");
  $detail->bindParam(":id_commande", $id_commande, PDO::PARAM_STR);
  $detail->execute();

  // Si la requête ne renvoie aucun résultat, alors l'article n'existe pas
  if($detail->rowCount() < 1)
  {
    header("location:gestion_commande.php");
  }

}

// SELECT * FROM details_commande dc, article a WHERE dc.id_commande = :id_commande AND dc.id_article = a.id_article




// Les affichages commencent ici, on termine toujours le php par les affichages
require("../inc/header.inc.php");
require("../inc/nav.inc.php");
?>
    
  <div class="container">

    <div class="starter-template">
      <h1>Gestion commande</h1>
      <a href="?action=affichage" class="btn btn-primary">Afficher les commandes</a>
    </div>  
      <?php // echo $message; // messages destinés à l'utilisateur ?>
      <!-- Le = est un raccourci de echo, les balises ci dessus et ci dessous sont les mêmes, cela ne fonctionne que pour les echo -->
      <?= $message; ?>

      <?php
      if(isset($_GET['action']) && $_GET['action'] == 'affichage')
      { 
      ?>
      <div class="row">
        <div class="col-sm-12">
          <table border="1" style="width: 80%; margin: 0 auto; border-collapse: collapse; text-align: center;">
            <tr>
              <?php
                $commande = $pdo->query("SELECT id_commande, montant, date FROM commande");
                $nb_col = $commande->columnCount();
                for($i = 0; $i < $nb_col; $i++)
                {
                  $colonne = $commande->getColumnMeta($i);
                  echo '<th style="padding: 10px; text-align: center;">' . $colonne['name'] . '</th>';
                }
                echo '<th style="padding: 10px; text-align: center;">Détails commande</th>';
                ?>
            </tr>
            <?php
                while($ligne = $commande->fetch(PDO::FETCH_ASSOC))
                {
                  echo '<tr>';
                  echo '<td style="padding: 10px; text-align: center;">' . $ligne['id_commande'] . '</td>';
                  echo '<td style="padding: 10px; text-align: center;">' . $ligne['montant'] . ' €</td>';
                  echo '<td style="padding: 10px; text-align: center;">' . $ligne['date'] . '</td>';
                  echo '<td style="padding: 10px; text-align: center;"><a href="?action=detail&id_commande=' . $ligne['id_commande'] . '" class="btn btn-info"><span class="glyphicon glyphicon-paperclip"></span> Voir le détail de la commande</a></td>';
                  echo '</tr>';
                }
              ?>            
          </table>
        </div>
      </div>
      <?php
      }
      if(isset($_GET['action']) && $_GET['action'] == 'detail' && isset($_GET['id_commande']) && is_numeric($_GET['id_commande']))
      {
      ?>
      




      <?php
      }
      ?>
    </div><!-- /.container -->
<?php
require("../inc/footer.inc.php");