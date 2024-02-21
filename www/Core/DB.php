<?php

namespace App\Core;

class DB
{

    protected $pdo;
    protected string $table;
    private static $instance;


    public function __construct()
    {
        try {
            $this->pdo = new \PDO(PDO_DSN);
        } catch (\PDOException $e) {
            echo "Erreur SQL : " . $e->getMessage();
        }


        $table = get_called_class();
        $table = explode("\\", $table);
        $table = array_pop($table);
        $this->table = TABLE_PREFIX . strtolower($table);
    }

    public static function getInstance(): self
    {
        if (is_null(self::$instance)) {
            self::$instance = new static();
        }
        return self::$instance;
    }


    public function getDataObject(): array
    {
        return array_diff_key(get_object_vars($this), get_class_vars(get_class()));

    }


    public function save()
    {
        $data = $this->getDataObject();

        if (empty($this->getId())) {
            $sql = "INSERT INTO " . $this->table . "(" . implode(",", array_keys($data)) . ") 
            VALUES (:" . implode(",:", array_keys($data)) . ")";
        } else {
            $sql = "UPDATE " . $this->table . " SET ";
            foreach ($data as $column => $value) {
                $sql .= $column . "=:" . $column . ",";
            }
            $sql = substr($sql, 0, -1);
            $sql .= " WHERE id = " . $this->getId();
        }
        $queryPrepared = $this->pdo->prepare($sql);
        $queryPrepared->execute($data);

    }


    public function prepare($sql)
    {
        return $this->pdo->prepare($sql);
    }

    public static function populate(int $id): object
    {
        $class = get_called_class();
        $object = new $class();
        return $object->getOneBy(["id" => $id], "object");
    }

    // $data = ["id"=>1] ou ["email"=>"y.skrypczyk@gmail.com"]
    public function getOneBy(array $data, string $return = "array")
    {
        $sql = "SELECT * FROM " . $this->table . " WHERE ";
        foreach ($data as $column => $value) {
            $sql .= " " . $column . "=:" . $column . "AND";
        }
        $sql = substr($sql, 0, -3);
        $queryPrepared = $this->pdo->prepare($sql);
        $queryPrepared->execute($data);

        if ($return == "object") {
            $queryPrepared->setFetchMode(\PDO::FETCH_CLASS, get_called_class());
        }

        return $queryPrepared->fetch();
    }


    public function ORMLiteSQL($operation = null, $champs = null, $value = null)
    {
        try
        {
            if ($operation == "SELECT")
            {
                if ($champs && $value)
                {
                    $query = $this->pdo->prepare("SELECT * FROM " . $this->table . " WHERE " . $champs . " = :value");
                    $query->bindParam(':value', $value);
                    $query->execute();
                }
                else
                {
                    $query = $this->pdo->query("SELECT * FROM " . $this->table);
                }
            }
            if ($operation == "DELETE")
            {
                if ($champs && $value) {
                    $query = $this->pdo->prepare("DELETE FROM " . $this->table . " WHERE " . $champs . " = :value");
                    $query->bindParam(':value', $value);
                    $query->execute();
                    return $query->rowCount();
                } else {
                    $query = $this->pdo->query("DELETE FROM " . $this->table);
                    return $query->rowCount();
                }
            }
            return $query->fetchAll(\PDO::FETCH_ASSOC);
        }
        catch (\PDOException $e)
        {
            return [];
        }
    }



    public function CreateDB()
    {
        try {
            $dumpFilePath = __DIR__ . '/dump.sql'; // Chemin relatif depuis DB.php
            $sqlDump = file_get_contents($dumpFilePath);
            $sqlDump = str_replace('esgi_', TABLE_PREFIX, $sqlDump);
            $this->pdo->exec($sqlDump);
        } catch (PDOException $e) {
            echo "Erreur lors de la connexion à la base de données : " . $e->getMessage();
        } catch (Exception $e) {
            echo "Une erreur s'est produite : " . $e->getMessage();
        }
    }
}