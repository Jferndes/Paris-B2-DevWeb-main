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

    public function getAllMissionForUser($userId)
    {
        // Requête SQL pour récupérer les missions en fonction de l'utilisateur
        $sql = "SELECT m.numeroDossier, s.nomStatut, u.nomUrgence, c.nom AS nomClient, c.prenom AS prenomClient
                FROM Missions m 
                INNER JOIN StatutMission s ON m.statut_id = s.id 
                INNER JOIN UrgenceMission u ON m.urgence_id = u.id 
                INNER JOIN Clients c ON m.client_id = c.id
                LEFT JOIN IntervenantsMission im ON m.numeroDossier = im.missison_id
                LEFT JOIN Intervenants i ON im.intervenant_id = i.matricule
                LEFT JOIN Standardistes std ON m.standardiste_id = std.matricule
                WHERE c.user_id = :userId AND (i.user_id IS NULL OR std.user_id IS NULL)";
        
        // Préparer et exécuter la requête
        $stmt = $this->link->prepare($sql);
        $stmt->bindParam(':userId', $userId, \PDO::PARAM_INT);
        $stmt->execute();
        
        // Retourner les résultats
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
}
