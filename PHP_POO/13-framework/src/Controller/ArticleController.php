<?php

namespace Controller;

class ArticleController extends Controller
{
    // Via l'héritage avec la classe Mère Controller j'ai accès à getModel() qui récupère le modèle de la classe courante et à render() qui gère l'affichage

    // Affichage de la page boutique
    public function afficheAll()
    {
        // 1 : Récupérer tous les articles
        // 2 : Récupérer toutes les catégories
        // 3 : Envoyer la vue boutique.php

        $articles = $this->getModel()->getAllArticles();
        $categories = $this->getModel()->getAllCategories();

        $params = array(
            'articles' => $articles,
            'categories' => $categories,
            'title' => 'Ma super Boutique'
        );
        // Appelle ici de la méthode render issue de la classe mère Controller
        return $this->render('layout.html', 'boutique.html', $params);

        // require __DIR__ . '/../View/Article/boutique.php';
    }

    // Affichage d'une fuche article
    public function affiche($id)
    {
        // Récupérer l'article
        // 1.2 Récupérer toutes les suggestions d'articles
        // 2 Afficher la view fiche_article.php

        // Ici $article est un article de la classe Entity\Article
        $article = $this->getModel()->getArticleById($id);

        $params = array(
            'article' => $article,
            'title' => 'Article : ' . $article->getTitre()
        );

        return $this->render('layout.html', 'fiche_article.html', $params);
        // require __DIR__ . '/../View/Article/fiche_article.php';
    }

    // Affichage des articles d'une catégorie
    public function categorie($categorie)
    {
        // 1 : Récupérer tous les produits d'une catégorie
        // 2 : Récupérer toutes les catégories
        // 3 : Afficher la vue de boutique.php

        $articles = $this->getModel()->getAllArticlesByCategorie($categorie);
        $categories = $this->getModel()->getAllCategories();

        $params = array(
            'articles' => $articles,
            'categories' => $categories,
            'title' => 'Catégories d\'articles :' . $categorie
        );

        return $this->render('layout.html', 'boutique.html', $params);

        // require __DIR__ . '/../View/Article/boutique.php';
    }
}