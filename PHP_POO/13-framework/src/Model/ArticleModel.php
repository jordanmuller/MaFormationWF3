<?php

// Lors de l'utilisation d'un framework, c'est à partir de ce fichier que l'on commence à coder

namespace Model;

// Besoin de PDO, Model utilise déjà PDOManager pour les requêtes SPECIFIQUES, pas pour les génériques ou tout est déjà établi
use PDO;

// On crée la classe ArticleModel héritière de la classe mère Model
// Les méthodes seront utilisées par le contrôlleur, ici 
class ArticleModel extends Model
{
    // On renomme les méthodes de manière plus parlante, on fera la même cchose sur CommandeModel.php et MembreModel.php
    public function getAllArticles()
    {
        return $this->findAll();
    }

    public function getArticleById($id)
    {
        return $this->find($id);
    }

    public function deleteArticleById($id)
    {
        return $this->delete($id);
    }

    public function updateArticleById($id, $infos)
    {
        return $this->update($id, $infos);
    }

    public function registerArticle($infos)
    {
        return $this->register($infos);
    }

    // ------------------------------

    // requete qui récupère toutes les catégories :
    public function getAllCategories()
    {
        $requete = "SELECT DISTINCT categorie FROM article";
        // getConnexion_Db est héritée de la classe mère modèle
        $resultat = $this->getConnexion_Db()->query($requete);
        // Les catégories ne sont pas des objets car il n'y a pas de classe Catégorie
        $categories = $resultat->fetchAll(PDO::FETCH_ASSOC);

        if(!$categories)
        {
            return false;
        } else {
            return $categories;
        }
    }

    // requête qui récupère tous les enregistrements de la table article en fonction de la catégorie
    public function getAllArticlesByCategorie($categorie)
    {
        $requete = "SELECT * FROM article WHERE categorie = :categorie";
        $resultat = $this->getConnexion_Db()->prepare($requete);
        $resultat->bindParam(':categorie', $categorie, PDO::PARAM_STR);
        $resultat->execute();
        // Les articles récupérés seront des objets issus des classes présentes dans le dossier Entity
        $resultat->setfetchMode(PDO::FETCH_CLASS, 'Entity\Article');

        $articles = $resultat->fetchAll();

        if(!$articles)
        {
            return false;
        } else {
            return $articles;
        }
    }
}