<?php

/**
 * CE FICHIER DOIT AFFICHER UN ARTICLE ET SES COMMENTAIRES !
 * 
 * On doit d'abord récupérer le paramètre "id" qui sera présent en GET et vérifier son existence
 * Si on n'a pas de param "id", alors on affiche un message d'erreur !
 * 
 * Sinon, on va se connecter à la base de données, récupérer les commentaires du plus ancien au plus récent (SELECT * FROM comments WHERE article_id = ?)
 * 
 * On va ensuite afficher l'article puis ses commentaires
 */
require_once("Libraries/database.php");
require_once("Libraries/utilis.php");
require_once("Libraries/models/Comment.php");
require_once("Libraries/models/Article.php");

/**
 * 1. Récupération du param "id" et vérification de celui-ci
 */
// On part du principe qu'on ne possède pas de param "id"
$article_id = null;

// Mais si il y'en a un et que c'est un nombre entier, alors c'est cool
if (!empty($_GET['id']) && ctype_digit($_GET['id'])) {
    $article_id = $_GET['id'];
}

// On peut désormais décider : erreur ou pas ?!
if (!$article_id) {
    die("Vous devez préciser un paramètre `id` dans l'URL !");
}

/**
	 * 3. Récupération de l'article en question
	 */
$articleModel = new Article();
$article = $articleModel->find($article_id);

/**
 * 4. Récupération des commentaires de l'article en question
 */
$commentaireModel = new Comment();
$commentaires = $commentaireModel->findAll($article_id);

/**
 * 5. On affiche 
 *compact créait un tableau assiocatif (avec sa clef) de donnée.
 */
render('articles/show',compact(
	'pageTitle' ,
	'article' ,
	"commentaires", 
	'article_id'
));