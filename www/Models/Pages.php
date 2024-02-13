<?php

namespace App\Models;

use App\Core\DB;

class Pages extends DB
{

    private ?int $id = null;
    protected String $title;
    protected String $meta_description;
    protected String $titre;
    protected string $banniere;
    protected int $articleid;
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
     * Get the value of titre
     */ 
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * Set the value of titre
     *
     * @return  self
     */ 
    public function setTitre($titre)
    {
        $this->titre = $titre;

    }

    /**
     * Get the value of bannière
     */ 
    public function getBannière()
    {
        return $this->bannière;
    }

    /**
     * Set the value of bannière
     *
     * @return  self
     */ 
    public function setBannière($bannière)
    {
        $this->bannière = $bannière;
    }

    /**
     * Get the value of articleid
     */ 
    public function getArticleid()
    {
        return $this->articleid;
    }

    /**
     * Set the value of articleid
     *
     * @return  self
     */ 
    public function setArticleid($articleid)
    {
        $this->articleid = $articleid;
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

        return $this;
    }
    }
