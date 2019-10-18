<?php

require_once('libraries/models/Model.php');

/**
 * 
 */
class Comment extends Model
{
	/**
	 *retourne la liste des commentaires
	 *
	 * @return array
	 */
	public function findAll($id)
	{
		$query = $this->pdo->prepare("SELECT * FROM comments WHERE article_id = :article_id");
		$query->execute(['article_id' => $id]);
		$commentaires = $query->fetchAll();
		return $commentaires;
	}

	/**
	 *retourne un commentaire
	 *
	 * @param integer $id
	 * @return array|bool le commentaire sinon false
	 */
	public function find($id)
	{
		$query = $this->pdo->prepare('SELECT * FROM comments WHERE id = :id');
		$query->execute(['id' => $id]);
		$comment = $query->fetch();
		return $comment;
	}

	/**
	 *supprime un commentaire
	 *
	 * @param integer $id
	 * @return void
	 */
	public function delete($id)
	{
		$query = $this->pdo->prepare('DELETE FROM comments WHERE id = :id');
		$query->execute(['id' => $id]);
	}

	/**
	 *insert un commentaire dans la bdd
	 *
	 * @param string $author
	 * @param string $content
	 * @param integer $id
	 * @return void
	 */
	public function insert($author, $content, $id)
	{
		$query = $this->pdo->prepare('INSERT INTO comments SET author = :author, content = :content, article_id = :id, created_at = NOW()');
		$query->execute(compact('author', 'content', 'id'));
	}
}
