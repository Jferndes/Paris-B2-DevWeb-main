<?php

namespace App;

class Intervenants extends Repo
{
    private $id;
    private $misison_id;
    private $intervenant_id;
    private $created_at;
    private $updated_at;


    public function __construct()
    {
        parent::__construct();
    }

    public function insertIntervenantMission(array $data)
    {
        $sql = "INSERT INTO IntervenantsMission (misison_id, intervenant_id) VALUES (:misison_id, :intervenant_id)";
        $stmt = $this->link->prepare($sql);
        $stmt->execute($data);
    }

    public function getIntervenantByMissionId(array $data)
    {
        $sql = "SELECT * FROM IntervenantsMission WHERE misison_id = :misison_id";
        $stmt = $this->link->prepare($sql);
        $stmt->execute($data);
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }
}
