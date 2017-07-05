<?php
require("../inc/init.inc.php");

if(!utilisateur_connecte_admin())
{
  header("location:../connexion.php");
  exit(); // permet d'arrêter l'exécution du script
}

  if(isset($_GET['action']) && $_GET['action'] == 'supprimer' && !empty($_GET['id_membre']) && is_numeric($_GET['id_membre']))
  {
    $id_membre = $_GET['id_membre'];
    $membre_a_supprimer = $pdo->prepare("DELETE FROM membre WHERE id_membre = :id_membre AND statut = 0");
    $membre_a_supprimer->bindParam(":id_membre", $id_membre, PDO::PARAM_STR);
    $membre_a_supprimer->execute();

    $message .= '<div class="alert alert-success" role="alert" style="margin-top: 20px;">Le membre numéro ' . $id_membre . ' a bien été supprimé</div>';
  }

  if(isset($_GET['action']) && $_GET['action'] == 'modifier' && !empty($_GET['id_membre']) && is_numeric($_GET['id_membre']) && isset($_GET['statut']) && is_numeric($_GET['statut']) && isset($_GET['etat']))
  {
    echo '<pre>'; print_r($_GET); echo '</pre>';
    $statut = $_GET['statut'];
    $id_membre = $_GET['id_membre'];
    $etat = $_GET['etat'];
    if($statut == 0 && $etat == 'admin')
    {
      $modif_statut = $pdo->prepare("UPDATE membre SET statut = 1 WHERE id_membre = :id_membre AND statut = :statut");
      $modif_statut->bindParam(":id_membre", $id_membre, PDO::PARAM_STR);
      $modif_statut->bindParam(":statut", $statut, PDO::PARAM_STR);
      $modif_statut->execute();
      $message .= '<p>Vous devenez admin</p>';
    } 
    elseif ($statut == 1 && $etat == 'membre') 
    {
      $modif_statut = $pdo->prepare("UPDATE membre SET statut = 0 WHERE id_membre = :id_membre AND statut = :statut");
      $modif_statut->bindParam(":id_membre", $id_membre, PDO::PARAM_STR);
      $modif_statut->bindParam(":statut", $statut, PDO::PARAM_STR);
      $modif_statut->execute();
      $message .= '<p>Vous devenez membre</p>';
    }
    // On n'effectue qu'une seule redirection car l'id est spécifique
    header("location: gestion_utilisateur.php");
  }





// Les affichages commencent ici, on termine toujours le php par les affichages
require("../inc/header.inc.php");
require("../inc/nav.inc.php");
?>
    
    <div class="container">

      <div class="starter-template">
        <h1>Gestion utilisateur</h1>
      </div>  
        <?php // echo $message; // messages destinés à l'utilisateur ?>
        <!-- Le = est un raccourci de echo, les balises ci dessus et ci dessous sont les mêmes, cela ne fonctionne que pour les echo -->
        <?= $message; ?>

        <div class="row">
          <div class="col-sm-12">
            <table border="1" style="width: 80%; margin: 0 auto; border-collapse: collapse; text-align: center;">
              <tr>
                <?php
                  $info_membre = $pdo->query("SELECT * FROM membre");
                  $nb_col = $info_membre->columnCount();
                  for($i = 0; $i < $nb_col; $i++)
                  {
                    $colonne = $info_membre->getColumnMeta($i);
                    echo '<th style="padding: 10px; text-align: center;">' . $colonne['name'] . '</th>';
                  }
                  echo '<th style="padding: 10px; text-align: center;">Supprimer</th>';
                  echo '<th style="padding: 10px; text-align: center;">Modier</th>';
                  echo '</tr>';
                  while($ligne = $info_membre->fetch(PDO::FETCH_ASSOC))
                  {
                    echo '<tr>';
                    foreach($ligne AS $indice => $info)
                   
                      {
                        echo '<td style="padding: 10px; text-align: center;">' . $info . '</th>';
                      }
                      
                        echo '<td style="padding: 10px; text-align: center;"><a href="?action=supprimer&id_membre=' . $ligne['id_membre'] . '" class="btn btn-danger">Supprimer</a></td>';
                        echo '<td style="padding: 10px; text-align: center;">
                                <div class="btn-group">
                                  <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Changer statut <span class="caret"></span>
                                  </button>
                                  <ul class="dropdown-menu">
                                    <li><a href="?action=modifier&id_membre=' . $ligne['id_membre'] . '&statut=' . $ligne['statut'] . '&etat=membre">Membre</a></li>
                                    <li><a href="?action=modifier&id_membre=' . $ligne['id_membre'] . '&statut=' . $ligne['statut'] . '&etat=admin">Admin</a></li>
                                  </ul>
                                </div>                                                              
                              </td>';
                      
                      echo '</tr>';
                  }

                ?>
              </tr>
            </table>
          </div>
        </div>


      

    </div><!-- /.container -->
<?php
require("../inc/footer.inc.php");