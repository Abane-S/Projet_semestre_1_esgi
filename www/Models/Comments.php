<?php

namespace App\Models;

namespace App\Models;

use App\Core\DB;

class Comments extends DB
{
    private ?int $id = null;
    protected Int $id_page;
    protected Int $valid;
    protected String $fullname;
    protected String $commenttitle;
    protected String $comment;

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


    public function getIdPage(): int
    {
        return $this->id_page;
    }

    public function setIdPage(int $id_page): void
    {
        $this->id_page = $id_page;
    }


    public function getValid(): int
    {
        return $this->valid;
    }

    public function setValid(int $valid): void
    {
        $this->valid = $valid;
    }

    public function getFullname(): string
    {
        return $this->fullname;
    }

    public function setFullname(string $fullname): void
    {
        $this->fullname = $fullname;
    }

    public function getCommenttitle(): string
    {
        return $this->commenttitle;
    }

    public function setCommenttitle(string $commenttitle): void
    {
        $this->commenttitle = $commenttitle;
    }

    public function getComment(): string
    {
        return $this->comment;
    }

    public function setComment(string $comment): void
    {
        $this->comment = $comment;
    }


    public function ShowAllValidComments($id_page): array
    {
        try {
            $sql = "SELECT fullname, commenttitle, comment, updated_at 
                FROM " . $this->table . " 
                WHERE valid = true AND id_page = :id_page";
            $queryPrepared = $this->pdo->prepare($sql);
            $queryPrepared->execute(['id_page' => $id_page]);

            $result = $queryPrepared->fetchAll(\PDO::FETCH_ASSOC);

            return $result;
        } catch (\PDOException $e) {
            return [];
        }
    }

    public function deleteComment($idComment)
    {
        try {
            $sql = "DELETE FROM " . $this->table . " WHERE id = :id";
            $queryPrepared = $this->pdo->prepare($sql);
            $queryPrepared->execute(['id' => $idComment]);

            $rowCount = $queryPrepared->rowCount(); // Nombre de lignes affectées

            return $rowCount;
        } catch (\PDOException $e) {
            // Gérer l'erreur ici si nécessaire
            return 0; // Retourner 0 en cas d'échec
        }
    }

    public function getAllComments(): array
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
