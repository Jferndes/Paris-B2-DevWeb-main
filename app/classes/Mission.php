<?php

namespace App;

class Mission extends Repo
{
    private $numeroDossier;
    private $statut_id;
    private $urgence_id;
    private $adresse_id;
    private $commentaire_id;
    private $motif;
    private $intervenantMission_id;
    private $standardiste_id;
    private $client_id;
    private $created_at;
    private $updated_at;


    public function __construct()
    {
        parent::__construct();
    }

    public function insertMission(array $data)
    {
        $sql = "INSERT INTO Mission (numeroDossier, statut_id, urgence_id, adresse_id, commentaire_id, motif, intervenantMission_id, standardiste_id, client_id) VALUES (:numeroDossier, :statut_id, :urgence_id, :adresse_id, :commentaire_id, :motif, :intervenantMission_id, :standardiste_id, :client_id)";
        $stmt = $this->link->prepare($sql);
        $stmt->execute($data);
    }

    public function getAllMission()
    {
        $sql = "SELECT m.numeroDossier, s.nomStatut, u.nomUrgence, c.nom AS nomClient, c.prenom AS prenomClient
                FROM Missions m 
                INNER JOIN StatutMission s ON m.statut_id = s.id 
                INNER JOIN UrgenceMission u ON m.urgence_id = u.id 
                INNER JOIN Clients c ON m.client_id = c.id";
        $stmt = $this->link->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }


}
