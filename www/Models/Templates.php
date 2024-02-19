<?php

namespace App\Models;

use App\Core\DB;

class Templates extends DB
{

    private ?int $id = null;
    protected String $name;
    protected String $background_color;
    protected String $navbar_color;

    protected String $menu_color;

    protected int $default_tpl;

    public function getDefaultTpl(): int
    {
        return $this->default_tpl;
    }

    public function setDefaultTpl(int $default_tpl): void
    {
        $this->default_tpl = $default_tpl;
    }

    public function getMenuColor(): string
    {
        return $this->menu_color;
    }

    public function setMenuColor(string $menu_color): void
    {
        $this->menu_color = $menu_color;
    }

    public function getActive(): int
    {
        return $this->active;
    }

    public function setActive(int $active): void
    {
        $this->active = $active;
    }

    public function getTextColor(): string
    {
        return $this->text_color;
    }

    public function setTextColor(string $text_color): void
    {
        $this->text_color = $text_color;
    }

    public function getPoliceSize(): int
    {
        return $this->police_size;
    }

    public function setPoliceSize(int $police_size): void
    {
        $this->police_size = $police_size;
    }

    public function getPoliceName(): string
    {
        return $this->police_name;
    }

    public function setPoliceName(string $police_name): void
    {
        $this->police_name = $police_name;
    }

    protected int $active;

    protected String $text_color;

    protected int $police_size;

    protected String $police_name;


    public function getNavbarColor(): string
    {
        return $this->navbar_color;
    }

    public function setNavbarColor(string $navbar_color): void
    {
        $this->navbar_color = $navbar_color;
    }


    public function __construct()
    {
        parent::__construct();
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getBackgroundColor(): string
    {
        return $this->background_color;
    }

    public function setBackgroundColor(string $background_color): void
    {
        $this->background_color = $background_color;
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

    public function getAllTemplate(): array
    {
        $sql = "SELECT * FROM ". $this->table ;
        $query = $this->pdo->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }

    public function deleteTPL($idTPL)
    {
        try {
            $sql = "DELETE FROM " . $this->table . " WHERE id = :id";
            $queryPrepared = $this->pdo->prepare($sql);
            $queryPrepared->execute(['id' => $idTPL]);

            $rowCount = $queryPrepared->rowCount(); // Nombre de lignes affectées

            return $rowCount;
        } catch (\PDOException $e) {
            // Gérer l'erreur ici si nécessaire
            return 0; // Retourner 0 en cas d'échec
        }
    }

}
