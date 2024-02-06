<?php

namespace App;

class Repo
{   
    protected $link;

    function __construct()
    {
        try {
            $this->link = new \PDO('mysql:host=mysql;dbname=bd_accordEnergie', "root", "");
        } catch (\PDOException $e) {
            var_dump($e->getMessage());
            die();
        }
    }

    public function getAllTable(string $table)
    {
        $stmt = $this->link->prepare("SELECT * FROM $table");
        $stmt->execute();
        return $stmt->fetchAll();
    }

}