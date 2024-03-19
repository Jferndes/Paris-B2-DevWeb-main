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

    public function getAllInfoMission(int $mission_id)
    {
        $sql = "SELECT  m.numeroDossier, m.motif, 
                        st.nom AS StandardisteNom, st.prenom AS StandardistePrenom, st.tel AS StandardisteTel, st.email AS StandardisteEmail,
                        c.nom AS ClientNom, c.prenom AS ClientPrenom, c.tel AS ClientTel, c.email AS ClientEmail,
                        a.numero AS AdresseNumero, a.rue AS AdresseRue, a.ville AS AdresseVille, a.codePostal AS AdresseCodePostal, a.pays AS AdressePays,
                        s.nomStatut, u.nomUrgence
                FROM Missions m 
                INNER JOIN StatutMission s ON m.statut_id = s.id 
                INNER JOIN UrgenceMission u ON m.urgence_id = u.id 
                INNER JOIN Standardistes st ON  m.standardiste_id = st.matricule
                INNER JOIN Clients c ON m.client_id = c.id
                INNER JOIN Adresses a ON a.id = c.adresse_id
                WHERE m.numeroDossier = $mission_id";
        $stmt = $this->link->prepare($sql);
        $stmt->execute();
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public function getMyMissions(int $userId)
    {
        $sql = "SELECT m.numeroDossier, s.nomStatut, u.nomUrgence, c.nom AS nomClient, c.prenom AS prenomClient
                FROM Missions m 
                    INNER JOIN StatutMission s ON m.statut_id = s.id 
                    INNER JOIN UrgenceMission u ON m.urgence_id = u.id 
                    INNER JOIN Clients c ON m.client_id = c.id
                    INNER JOIN Standardistes st ON  m.standardiste_id = st.matricule
                    LEFT JOIN IntervenantsMission i ON m.numeroDossier = i.missison_id
                WHERE
                    m.statut_id != 1
                    AND ( c.user_id = :userId
                        OR st.user_id = :userId
                        OR (SELECT user_id FROM Intervenants j WHERE j.matricule = i.intervenant_id) = :userId
                        )
                ORDER BY
                    m.created_at DESC
                LIMIT 3
                "; 
        $stmt = $this->link->prepare($sql);
        $stmt->execute(['userId' => $userId]);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }



}
