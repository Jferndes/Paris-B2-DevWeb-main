<?php

namespace App;

class Adresses extends Repo
{
    private $id;
    private $numero;
    private $rue;
    private $ville;
    private $codePostal;
    private $pays;
    private $client_id;
    private $created_at;
    private $updated_at;


    public function __construct()
    {
        parent::__construct();
    }

    public function insertAdresse(array $data)
    {
        $sql = "INSERT INTO Adresses (numero, rue, ville, codePostal, pays, client_id) VALUES (:numero, :rue, :ville, :codePostal, :pays, :client_id)";
        $stmt = $this->link->prepare($sql);
        $stmt->execute($data);
    }

    public function getAdresseByClient(array $data)
    {
        $sql = "SELECT * FROM Adresses WHERE client_id = :client_id";
        $stmt = $this->link->prepare($sql);
        $stmt->execute($data);
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }
}
