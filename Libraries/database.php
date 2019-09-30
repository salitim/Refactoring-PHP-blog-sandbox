<?php

/**
*Retourn une connexion à la BDD
*@return PDO
**/
function getPdo()
{

return new PDO('mysql:host=localhost;dbname=blogpoo;charset=utf8', 'root', 'root', [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
]);

}

/**
*retourne la liste des articles
*
* @return array
*/
function findAll()
{
	$pdo = getPdo();
	
	// On utilisera ici la méthode query (pas besoin de préparation car aucune variable n'entre en jeu)
	$resultats = $pdo->query('SELECT * FROM articles ORDER BY created_at DESC');
	// On fouille le résultat pour en extraire les données réelles
	$articles = $resultats->fetchAll();

	return $articles;
}

/**
*retourne la liste un article
*
* @return array
*/
function findArticle($id)
{
	$pdo = getPdo();
	
	$query = $pdo->prepare("SELECT * FROM articles WHERE id = :article_id");
	// On exécute la requête en précisant le paramètre :article_id 
	$query->execute(['article_id' => $id]);
	// On fouille le résultat pour en extraire les données réelles de l'article
	$article = $query->fetch();

	return $article;
}

/**
*retourne la liste un article
*
* @return array
*/
function findAllComments($id)
{	
	$pdo = getPdo();
	$query = $pdo->prepare("SELECT * FROM comments WHERE article_id = :article_id");
	$query->execute(['article_id' => $id]);
	$commentaires = $query->fetchAll();
	return $commentaires;
}

function deleteArticle($id)
{	
	$pdo = getPdo();
	$query = $pdo->prepare('DELETE FROM articles WHERE id = :id');
	$query->execute(['id' => $id]);

}

function findComment($id)
{	
	$pdo = getPdo();
	$query = $pdo->prepare('SELECT * FROM comments WHERE id = :id');
	$query->execute(['id' => $id]);
	$comment = $query->fetch();
	return $comment;
}

function deleteComment($id)
{	
	$pdo = getPdo();
	$query = $pdo->prepare('DELETE FROM comments WHERE id = :id');
	$query->execute(['id' => $id]);
}

function insertComment($author,$content,$id)
{	
	$pdo = getPdo();
	$query = $pdo->prepare('INSERT INTO comments SET author = :author, content = :content, article_id = :id, created_at = NOW()');
	$query->execute(compact('author', 'content', 'id'));
}