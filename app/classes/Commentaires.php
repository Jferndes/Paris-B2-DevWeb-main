<?php

namespace App;

class Commentaires extends Repo
{
    private $id;
    private $commentaire;
    private $user_id;
    private $created_at;
    private $updated_at;


    public function __construct()
    {
        parent::__construct();
    }

    public function insertCommentaire(array $data)
    {
        $sql = "INSERT INTO Commentaires (commentaire, user_id) VALUES (:commentaire, :user_id)";
        $stmt = $this->link->prepare($sql);
        $stmt->execute($data);
    }

    public function getCommentaireByUser(array $data)
    {
        $sql = "SELECT * FROM Commentaires WHERE user_id = :user_id";
        $stmt = $this->link->prepare($sql);
        $stmt->execute($data);
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }
}
