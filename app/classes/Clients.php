<?php

namespace App;

class Clients extends Repo
{
    private $id;
    private $nom;
    private $prenom;
    private $tel;
    private $email;
    private $adresse_id;
    private $user_id;
    private $created_at;
    private $updated_at;


    public function __construct()
    {
        parent::__construct();
    }

    public function insertClient(array $data)
    {
        $sql = "INSERT INTO Clients (nom, prenom, tel, email, adresse_id, user_id) VALUES (:nom, :prenom, :tel, :email, :adresse_id, :user_id)";
        $stmt = $this->link->prepare($sql);
        $stmt->execute($data);
    }

    public function getClientByEmail(array $data)
    {
        $sql = "SELECT * FROM Clients WHERE email = :email";
        $stmt = $this->link->prepare($sql);
        $stmt->execute($data);
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }
}
