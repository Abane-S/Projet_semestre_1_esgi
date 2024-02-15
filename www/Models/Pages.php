<?php

namespace App\Models;

use App\Core\DB;

class Pages extends DB
{

    private ?int $id = null;
    protected String $title;
    protected String $meta_description;
    protected String $miniature;
    protected Int $comments;
    protected String $content;


    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

    }

    /**
     * Get the value of title
     */ 
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set the value of title
     *
     * @return  self
     */ 
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * Get the value of meta_description
     */ 
    public function getMeta_description()
    {
        return $this->meta_description;
    }

    /**
     * Set the value of meta_description
     *
     * @return  self
     */ 
    public function setMeta_description($meta_description)
    {
        $this->meta_description = $meta_description;

    }

    /**
     * Get the value of miniature
     */ 
    public function getminiature()
    {
        return $this->miniature;
    }

    /**
     * Set the value of miniature
     *
     * @return  self
     */ 
    public function setMiniature($miniature)
    {
        $this->miniature = $miniature;

    }


    public function getAllPages(): array
    {
            $sql = "SELECT * FROM ". $this->table ;
            $query = $this->pdo->prepare($sql);
            $query->execute();
            return $query->fetchAll();
    }


    public function deletePage($idPage)
    {
        try {
            $sql = "DELETE FROM " . $this->table . " WHERE id = :id";
            $queryPrepared = $this->pdo->prepare($sql);
            $queryPrepared->execute(['id' => $idPage]);

            $rowCount = $queryPrepared->rowCount(); // Nombre de lignes affectées

            return $rowCount;
        } catch (\PDOException $e) {
            // Gérer l'erreur ici si nécessaire
            return 0; // Retourner 0 en cas d'échec
        }
    }

    /**
     * Get the value of content
     */ 
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set the value of content
     *
     * @return  self
     */ 
    public function setContent($content)
    {
        $this->content = $content;

    }

    /**
     * Get the value of comments
     */ 
    public function getComments(): bool
    {
        return $this->comments;
    }

    /**
     * Set the value of comments
     *
     * @return  self
     */ 
    public function setComments(bool $comments)
    {
        $this->comments = $comments;

    }

}
