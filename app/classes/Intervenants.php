<?php

namespace App;

class Intervenants extends Repo
{
    private $id;
    private $matricule;
    private $nom;
    private $prenom;
    private $tel;
    private $email;
    private $user_id;
    private $created_at;
    private $updated_at;


    public function __construct()
    {
        parent::__construct();
    }

    public function insertIntervenant(array $data)
    {
        $sql = "INSERT INTO Intervenants (matricule, nom, prenom, tel, email, user_id) VALUES (:matricule, :nom, :prenom, :tel, :email, :user_id)";
        $stmt = $this->link->prepare($sql);
        $stmt->execute($data);
    }

    public function getIntervenantByEmail(array $data)
    {
        $sql = "SELECT * FROM Intervenants WHERE email = :email";
        $stmt = $this->link->prepare($sql);
        $stmt->execute($data);
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }
}
