<?php

namespace Repositories;

use PDO;
use Models\Room;
use Services\Database;

class RoomRepository
{
    private PDO $pdo;
    
    public function __construct(){
        // lancer la connexion a la BDD 
        $db = new Database();
        $this -> pdo = $db -> getConnection();
    }

    // Retourne un tableau d'objets Room
    public function findAll()
    {
        $stmt = $this->pdo->query("SELECT * FROM room ORDER BY created_at DESC");
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $rooms = [];
        foreach ($rows as $row) {
            $room = new Room();
            $room->setId($row['id']);
            $room->setTitle($row['title']);
            $room->setCreatedAt($row['created_at']);

            $rooms[] = $room;
        }

        return $rooms;
    }

    // Retourne un objet Room unique
    public function findById($id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM room WHERE id = ?");
        $stmt->execute([$id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$row) {
            return null; 
        }

        $room = new Room();
        $room->setId($row['id']);
        $room->setTitle($row['title']);
        $room->setCreatedAt($row['created_at']);

        return $room;
    }
    
    public function findByName(string $name){
        $query = $this -> pdo -> prepare("SELECT * FROM room WHERE title = :title");
        $query -> execute (['title' => $name]);
        
        return $query -> fetch();
    }

    public function saveRoom(Room $room){
        
        // lancer l'insertion
        
        $sql = "INSERT INTO room(title, created_at) VALUES (:title, NOW())";
        
        $stmt = $this -> pdo -> prepare($sql);
        
        $test = $stmt -> execute([
                'title' => $room -> getTitle(),
            ]);
            
            return $test;
    }
}