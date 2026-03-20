<?php

namespace Models;

class Message
{
    private $id;
    private $content;
    private $created_at;

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
}