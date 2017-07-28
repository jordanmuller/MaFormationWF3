<?php

namespace Controller;

// On utilise tous les namespaces Model, celui de vendor et de src
use Model;

class Controller 
{
    protected $model; // Contiendra un objet Model correspondant au controller dans le quel je suis. (ex: ArticleController ----> ArticleModel)

    // Cela permet de récupérer le modèle voulu pour interagir avec la BDD
    public function getModel()
    {
        // get_called_class() retourne la classe où je suis -> Controller\ArticleController
        $class = 'Model\\' . str_replace(array('Controller\\', 'Controller'), '', get_called_class()) . 'Model';
        //  La ligne ci-dessus a transformé "Controller\ArticleController" en "Model\ArticleModel"
        $this->model = new $class;
        // $this->model = new Model\ArticleModel

        return $this->model;
    }

    // render() attend 3 arguments, le layout correspondant, la view (ici Article), et les paramètres passés dans un array, les paramètres sont définis dans par ex ArticleController.php
    public function render($layout, $view, array $params)
    {
        // On reconstitue le dossier qui mène aux views
        $dirView = __DIR__ . '/../../src/View/';
        // La ligne ci-dessous prend le nom du Controller dans le lequel je suis (ex Controler\ArticleController) et le transforme pour obtenir le nom de mon entité (ex: Article) et donc le dossier où se trouvent mes views
        $dirFile = str_replace(array('Controller\\', 'Controller'), '', get_called_class());

        // Le chemin vers les vues
        $path_view = $dirView . $dirFile . '/' . $view;
        //C://xampp/htdocs/PHP_POO/13-framework/src/View/Article/Boutique.html

        // Le chemin vers le layout
        $path_layout = $dirView . $layout;
        //C://xampp/htdocs/PHP_POO/13-framework/src/View/layout.html

        // Extract permet de transformer les indices de mon array $params en varables dans ma view.
        extract($params);

        // -------------------
        // Cela enclenche la temporisation de sortie, c'est à dire que la ligne qui suit ne va pas être exécutée mais retenue en mémoire tampon.
        ob_start();
        // Poupée moyenne, le require est gardé en mémoire, il n'est pas exécuté avant qu'on ne lui indique
        require $path_view;

        // Cela va mettre dans la variable $content ce qui a été précédemment retenu en mémoire-tampon (soit require $path_view)
        $content = ob_get_clean();

        ob_start();
        require $path_layout;

        // Retourne tout ce qui a été retenu. Il est obligatoire et éteint la temporisation
        return ob_end_flush();
    }
}