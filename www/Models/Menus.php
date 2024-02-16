<?php

namespace App\Models;

use App\Core\DB;

class Menus extends DB
{
    private ?int $id = null;
    protected String $title;
    protected String $meta_description;
    protected String $miniature;
    protected String $content;
    protected String $title_menu;
    protected String $icon_menu;

    public function __construct()
    {
        parent::__construct();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getMetaDescription(): string
    {
        return $this->meta_description;
    }

    public function setMetaDescription(string $meta_description): void
    {
        $this->meta_description = $meta_description;
    }

    public function getMiniature(): string
    {
        return $this->miniature;
    }

    public function setMiniature(string $miniature): void
    {
        $this->miniature = $miniature;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function setContent(string $content): void
    {
        $this->content = $content;
    }

    public function getTitleMenu(): string
    {
        return $this->title_menu;
    }

    public function setTitleMenu(string $title_menu): void
    {
        $this->title_menu = $title_menu;
    }

    public function getIconMenu(): string
    {
        return $this->icon_menu;
    }

    public function setIconMenu(string $icon_menu): void
    {
        $this->icon_menu = $icon_menu;
    }


    public function deleteMenu($idPage)
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

    public function getAllMenu(): array
    {
        try {
            $sql = "SELECT * FROM " . $this->table;
            $queryPrepared = $this->pdo->prepare($sql);
            $queryPrepared->execute();

            $result = $queryPrepared->fetchAll(\PDO::FETCH_ASSOC);

            return $result;
        } catch (\PDOException $e) {
            return [];
        }
    }

}
