<?php

require_once('libraries/database.php');

abstract class Model
{
    protected $pdo;
    protected $table = "comments";

    public function __construct()
    {
        $this->pdo = getPdo();
    }

    /**
     *retourne la liste des articles
     *
     * @return array
     */
    public function findAll($order)
    {
        $sql = "SELECT * FROM {$this->table}";

        if ($order) {
            $sql .= " ORDER BY " . $order;
        }

        $resultats = $this->pdo->query($sql);
        $articles = $resultats->fetchAll();
        return $articles;
    }

    /**
     *retourne  un item via l id
     * @param integer $id
     * @return void
     */
    public function find($id)
    {
        $query = $this->pdo->prepare("SELECT * FROM {$this->table}  WHERE id = :id");
        $query->execute(['id' => $id]);
        $item = $query->fetch();

        return $item;
    }

    /**
     * Supprime un item dans la base grâce à son identifiant
     * 
     * @param integer $id
     * @return void
     */
    public function delete($id)
    {
        $query = $this->pdo->prepare("DELETE  FROM {$this->table} WHERE id = :id");
        $query->execute(['id' => $id]);
    }
}
