<?php

namespace Repositories;

use PDO;
use Models\Message;
use Services\Database;

class MessageRepository{
    private PDO $pdo;
    
    public function __construct(){
        $db = new Database();
        $this -> pdo = $db -> getConnection();
        
    }
    
    public function findAll(){
        $stmt = $this -> pdo -> query("SELECT * FROM message ORDER BY created_at DESC");
        $rows = $stmt -> fetchAll(PDO::FETCH_ASSOC);
        
        $messages = [];
        foreach($rows as $row){
            $message = new Message();
            $message -> setId($row['id']);
            $message -> setContent($row['content']);
            $message -> setCreatedAt($row['created_at']);
            
            $messages[] = $message;
        }
        
        return $messages;
    }
    
    public function findByRoom(int $roomId){
        $stmt = $this -> pdo -> prepare("SELECT * FROM message WHERE room_id = :room_id ORDER BY created_at DESC");
        $stmt -> execute(['room_id' => $roomId]);
        $rows = $stmt -> fetchAll(PDO::FETCH_ASSOC);
        
        $messages = [];
        foreach ($rows as $row){
            $message = new Message();
            $message -> setId($row['id']);
            $message -> setContent($row['content']);
            $message -> setCreatedAt($row['created_at']);
            $message -> setRoomId($row['room_id']);
            
            $message->setIsPinned($row['is_pinned']);
            
            $messages[] = $message;
        }
    return $messages;
    }
    
    public function saveMessage(Message $message) {
        $sql = "INSERT INTO message (content, room_id, created_at) VALUES (:content, :room_id, NOW())";
        $stmt = $this->pdo->prepare($sql);
        
        return $stmt->execute([
            'content' => $message->getContent(),
            'room_id' => $message->getRoomId()
        ]);
    }
    
    public function pinMessage(int $messageId, int $roomId) {
 
        $stmt = $this->pdo->prepare("UPDATE message SET is_pinned = 0 WHERE room_id = :room_id");
        $stmt->execute(['room_id' => $roomId]);
    
        
        $stmt = $this->pdo->prepare("UPDATE message SET is_pinned = 1 WHERE id = :id");
        return $stmt->execute(['id' => $messageId]);
    }

    public function unpinMessage(int $messageId) {
        $stmt = $this->pdo->prepare("UPDATE message SET is_pinned = 0 WHERE id = :id");
        return $stmt->execute(['id' => $messageId]);
    }
}