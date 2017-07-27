<?php

namespace Model;
use PDO;
use Manager\PDOManager;

class Model
{
    private $connexion_db; // Contiendra notre objet $pdo

    // Fonction pour récupérer l'objet PDO
    public function getConnexion_Db()
    {
        $this->connexion_db = PDOManager::getInstance()->getPdo();
        // On renvoie la valeur de la propriété $connexion_db
        return $this->connexion_db;
    }

    // Méthode pour récupérer le nom de la table lors des requêtes génériques. Pour après effectuer des requêtes dynamiques en fonction du nom de la table
    public function getTableName()
    {
        // get_called_class(): méthode qui me retourne le nom de la classe dans laquelle je suis
        // ArticleModel ===> Model\ArticleModel ===> article
        // MembreModel ===> Model\MembreModel ===> membre

        // On remplace les deux parties 'Model', "\\" sert à nouveau é éviter l'échappement de l'apostrophe, à partir de la string renvoyée par get_called_class. On stocke le tout dans $table
        $table = strtolower(str_replace(array('Model\\', 'Model'), '', get_called_class()));

        // On renvoie la chaîne obtenue
        // return table
        return 'article';
    }

    // ---------------------
    // REQUETES GENERIQUES

    // 1) Requête pour récupérer toutes les infos d'une table, la requête s'effectue de manière dynamique
    public function findAll()
    {
        // $requete = "SELECT * FROM article";
        // $requete = "SELECT * FROM membre";
        // $requete = "SELECT * FROM commande";
        // Toujours mettre un espace entre FROM et "" sinon la requête échoue
        $requete = "SELECT * FROM " . $this->getTableName();

        // getDb() nous renvoie $pdo // donc $resultat = $pdo->query($requete);
        $resultat = $this->getConnexion_Db()->query($requete);
        // ucfirst() mettre la première lettre en majuscule
        // setFecthMode() est une fonction de PDOStatement. Cela permet d'instancier un objet (dans notre cas Entity\Article par exemple), de prendre les résultats de la requête et d'affecter à chaque propriété de l'objet les valeurs trouvées dans le champ correspondant dans la BDD. Pour que cela fonctionne, il faut ABSOLUMENT que les propriétés et les entités correspondent aux champs dans la BDD, le nom de la table et le nom des champs.
        $resultat->setFetchMode(PDO::FETCH_CLASS, 'Entity\\' . ucfirst($this->getTableName()));
        // new Entity\Article

        // Le fetchAll() permet de faire que chaque entrée dans la class Entity\ . $this->getTableName() crée un nouvel objet de la class Entity . $this->getTableNames()
        $donnees = $resultat->fetchAll();

        if(!$donnees)
        {
            return false;
        } else {
            return $donnees;
        }
    }

    // 2) Requête pour récupérer un enregistrement d'une table (par son id)
    public function find($id)
    {
        $requete = "SELECT * FROM " . $this->getTableName() . " WHERE id_" . $this->getTableName() . " = :id";
        $resultat = $this->getConnexion_Db()->prepare($requete);
        $resultat->bindParam(':id', $id, PDO::PARAM_INT);
        $resultat->execute();

        $resultat->setFetchMode(PDO::FETCH_CLASS, 'Entity\\' . ucfirst($this->getTableName()));

        $donnees = $resultat->fetch();

        if(!$donnees)
        {
            return false;
        } else {
            return $donnees;
        }
    }

    // 3) Requête pour su^^riùer un enregistrement d'une table (par son id)
    public function delete($id)
    {
        $requete = "DELETE FROM " . $this->getTableName() . " WHERE id_" . $this->getTableName() . " = :id";
        $resultat = $this->getConnexion_Db()->prepare($requete);
        // PARAM_INT permet de caster (changer le type de la valeur) avant de l'envoyer dans la requête
        $resultat->bindParam(':id', $id, PDO::PARAM_INT);
        // On effectue un return
        return $resultat->execute();
    }

    // 4) Requête pour modifier un enregistrement (par son ID)
    // On passe à la méthode deux arguments, l'id de l'objet à modifier et ses nouvelles infos
    public function update($id, $infos)
    {
        $newValues = '';
        $a = 0;
        foreach($infos AS $key => $value)
        {
            if($a == 0)
            { 
                $newValues .= " $key = :$key ";
                $a++;
            } else {
                $newValues .= ", $key = :$key ";
            }
        }

        $requete = "UPDATE " . $this->getTableName() . " SET " . $newValues . " WHERE id_" . $this->getTableName() . " = :id";
        $resultat = $this->getConnexion_Db()->prepare($requete);
        $infos['id'] = $id;
        
        return $resultat->execute($infos);

        // UPDATE article SET titre = :titre, categorie = :categorie WHERE id_article = :id
    }

    // 5) Requête d'insertion, pour  un enregistrement dans une table
    // On passe en paramètre toutes les insérerinfos contenues dans l'array $infos
    public function register($infos)
    {
        $requete = 'INSERT INTO ' . $this->getTableName() . ' (' . implode(',', array_keys($infos)) . ') VALUES (' . ":" . implode(", :", array_keys($infos)) . ')';
        // $requete = 'INSERT INTO article (titre, descriptio, prix) VALUES (:titre, :description, :prix)';

        $resultat = $this->getConnexion_Db()->prepare($requete);

        if($resultat->execute($infos))
        {
            // Retourne le dernier ID généré par la dernière requête d'insertion
            return $this->getConnexion_Db()->lastInsertId();
        }
        else {
            return false;
        }
    }
}