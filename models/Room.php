<?php

namespace Models;

use Exception;

class Room
{
    private $id;
    private $title;
    private $created_at;

    // getters

    public function getId()
    {
        return $this->id;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getCreatedAt()
    {
        return $this->created_at;
    }

    // SETTERS AVEC VALIDATION

    public function setId($id)
    {
        if (!preg_match('/^[0-9]+$/', $id)) {
            throw new Exception("ID invalide");
        }

        $this->id = (int) $id;
    }

    public function setTitle($title)
    {
        if (!preg_match('/^[a-zA-Z0-9À-ÿ\s\-\',.!?]{3,255}$/u', $title)) {
            throw new Exception("Titre invalide (3 à 255 caractères, lettres et chiffres uniquement)");
        }

        $this->title = trim($title);
    }

    public function setCreatedAt($created_at)
    {
        // Format attendu : YYYY-MM-DD HH:MM:SS
        if (!preg_match('/^\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2}$/', $created_at)) {
            throw new Exception("Format de date invalide");
        }

        $this->created_at = $created_at;
    }
}