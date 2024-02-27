<?php

namespace App;

class Standardistes extends Repo
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

    public function insertStandardiste(array $data)
    {
        $sql = "INSERT INTO Standardistes (matricule, nom, prenom, tel, email, user_id) VALUES (:matricule, :nom, :prenom, :tel, :email, :user_id)";
        $stmt = $this->link->prepare($sql);
        $stmt->execute($data);
    }

    public function getStandardisteByEmail(array $data)
    {
        $sql = "SELECT * FROM Standardistes WHERE email = :email";
        $stmt = $this->link->prepare($sql);
        $stmt->execute($data);
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }
}
