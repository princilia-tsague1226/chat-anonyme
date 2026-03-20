<?php

namespace Services;

use PDO;

class Database
{
    // Attributs privés
    private string $host = "db.3wa.io";
    private string $dbname = "princiliatsaguetefouegang_cours_MVC";
    private string $username = "princiliatsaguetefouegang";
    private string $password = "a238acca97d9f04fcd16f61247f1df85";
    private ?PDO $pdo = null;

    // Constructeur
    public function  __construct()
    {
        try {
            $this->pdo = new PDO(
                "mysql:host={$this->host};dbname={$this->dbname};charset=utf8",
                $this->username,
                $this->password
            );

            // Activation des erreurs PDO
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        } catch (PDOException $e) {
            die("Erreur de connexion : " . $e->getMessage());
        }
        
    }

    // Méthode publique pour récupérer la connexion
    public function getConnection(): PDO
    {
        return $this->pdo;
    }
}