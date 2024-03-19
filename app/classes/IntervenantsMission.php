<?php

namespace App;

class IntervenantsMission extends Repo
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

    public function getIntervenantsByMissionId(int $missionId)
    {
        $sql = "SELECT * FROM IntervenantsMission WHERE missison_id = $missionId";
        $stmt = $this->link->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
}
