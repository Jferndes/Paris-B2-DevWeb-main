<?php

namespace App;

class StatutMission extends Repo
{
    private $id;
    private $nomStatut;
    private $created_at;
    private $updated_at;


    public function __construct()
    {
        parent::__construct();
    }

    public function insertStatutMission(array $data)
    {
        $sql = "INSERT INTO StatutMission (nomStatut) VALUES (:nomStatut)";
        $stmt = $this->link->prepare($sql);
        $stmt->execute($data);
    }

    public function getStatutMissionByNom(array $data)
    {
        $sql = "SELECT * FROM StatutMission WHERE nomStatut = :nomStatut";
        $stmt = $this->link->prepare($sql);
        $stmt->execute($data);
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }
}
