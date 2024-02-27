<?php

namespace App;

class UrgenceMission extends Repo
{
    private $id;
    private $nomUrgence;
    private $logo;
    private $created_at;
    private $updated_at;


    public function __construct()
    {
        parent::__construct();
    }

    public function insertUrgenceMission(array $data)
    {
        $sql = "INSERT INTO UrgenceMission (matricule, nom, prenom, tel, email, user_id) VALUES (:matricule, :nom, :prenom, :tel, :email, :user_id)";
        $stmt = $this->link->prepare($sql);
        $stmt->execute($data);
    }

    public function getUrgenceMissionByNom(array $data)
    {
        $sql = "SELECT * FROM UrgenceMission WHERE nomStatut = :nomStatut";
        $stmt = $this->link->prepare($sql);
        $stmt->execute($data);
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }
}
