<?php

// Démarrage de la session
session_start();

// __DIR_ contient le chemin local, pas l'url pour y parvenir
require_once __DIR__ . '/../vendor/autoload.php';

/*
// Lancement de l'application (interrupteur)
$app = new Application;
$app->run();
*/

// // Test 1 Entity
// // Il faut préciser le namespace où se situe la classe Article du fichier Article.php, ici Entity\
// $article = new Entity\Article;
// $article->setTitre('Mon super article !');
// echo $article->getTitre();
// // localhost/PHPPoo/13-framework/web/index.php

// // TEST 2 : PDOManager
// // On crée l'objet $pdom à partir de la classe PDOManager situé dans le namespace Manager avec la méthode static getInstance()
// $pdom = Manager\PDOManager::getInstance();

// // On passe par la méthode public getPdo pour effectuer une requête SQL
// $resultat = $pdom->getPdo()->query("SELECT * FROM article");
// $articles = $resultat->fetchAll(PDO::FETCH_ASSOC);

// echo '<pre>';
// print_r($articles);
// echo '</pre>';

// Test 3 : Model
// On crée l'objet model de la classe mère Model
// $model = new Model\Model;
// $articles = $model->findAll();
// $infos = array(
//     'couleur' => 'rouge',
//     'sexe' => 'f'
// );
// // Modifier un produit
// $article = $model->update(6, $infos);
// $articles = $model->findAll();

// // Supprimer un produit
// $model->delete(4);

// // Ajouter un produit
// $nouveauArticle = array(
//     'id_article' => 4,
//     'reference' => '1324',
//     'categorie' => 'Parapluie',
//     'titre' => 'parapluie design',
//     'description' => 'Un super produit !!!!',
//     'taille' => 'l',
//     'couleur' => 'orange',
//     'sexe' => 'm',
//     'prix' => 12,
//     'stock' => 50
// );

// // $model->register($nouveauArticle);

// echo '<pre>';
// print_r($article);
// print_r($articles);
// echo '</pre>';

// Test 4 : ArticleModel

$am = new Model\ArticleModel;
$articles = $am->getAllArticles();
$article = $am->getArticleById(6);
$categories = $am->getAllCategories();
$article2 = $am->getAllArticlesByCategorie('chapeau');

echo '<pre>';
print_r($article2); 
echo '</pre>'; 