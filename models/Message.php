<?php

namespace Models;
use Exception;
class Message
{
    private $id;
    private $content;
    private $created_at;
    private $room_id;
    private $is_pinned;

    // getters

    public function getId()
    {
        return $this->id;
    }

    public function getContent()
    {
        return $this->content;
    }

    public function getCreatedAt()
    {
        return $this->created_at;
    }
    
    public function getRoomId()
    {
        return $this->room_id;
    }
    
    public function getIsPinned()
    {
        return $this->is_pinned;
    }
    
    // SETTERS AVEC VALIDATION

    public function setId($id)
    {
        if (!preg_match('/^[0-9]+$/', $id)) {
            throw new Exception("ID invalide");
        }

        $this->id = (int) $id;
    }

    public function setContent($content)
    {
        if (strlen(trim($content)) < 10) {
            throw new Exception("Le contenu doit contenir au moins 10 caractères");
        }

        $this->content = trim($content);
    }

    public function setCreatedAt($created_at)
    {
        // Format attendu : YYYY-MM-DD HH:MM:SS
        if (!preg_match('/^\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2}$/', $created_at)) {
            throw new Exception("Format de date invalide");
        }

        $this->created_at = $created_at;
    }
    
    public function setRoomId($room_id)
    {
        if (!preg_match('/^[0-9]+$/', $room_id)) {
            throw new Exception("ID du salon invalide");
        }

        $this->room_id = (int) $room_id;
    }
    
    public function setIsPinned($is_pinned)
    {
        if ($is_pinned != 0 && $is_pinned != 1) {
        throw new \Exception("La valeur de épinglage doit être 0 ou 1");
    }

    $this->is_pinned = (int) $is_pinned;
    }
}