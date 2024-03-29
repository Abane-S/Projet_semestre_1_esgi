<?php

namespace App\Models;

namespace App\Models;

use App\Core\DB;

class Comment extends DB
{
    private ?int $id = null;

    protected Int $id_page;

    protected Int $valid;

    public function getValid(): int
    {
        return $this->valid;
    }

    public function setValid(int $valid): void
    {
        $this->valid = $valid;
    }

    public function getIdPage(): int
    {
        return $this->id_page;
    }

    public function setIdPage(int $id_page): void
    {
        $this->id_page = $id_page;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    protected string $fullname;

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
    protected string $commenttitle;
    protected string $comment;

    public function ShowAllValidComments($id_page): array
    {
        try {
            $sql = "SELECT *
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

}
