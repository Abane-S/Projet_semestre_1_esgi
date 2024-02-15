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
        try {
            $queryPrepared = $this->pdo->prepare($sql);
            $queryPrepared->execute($data);
        } catch (PDOException $e) {
            error_log("Erreur SQL : " . $e->getMessage());
            echo "Erreur SQL : " . $e->getMessage();
        }
        
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
        try {
            $sql = "SELECT * FROM " . $this->table . " WHERE ";
            foreach ($data as $column => $value) {
                $sql .= $column . "=:" . $column . " AND ";
            }
            $sql = rtrim($sql, ' AND ');
            $queryPrepared = $this->pdo->prepare($sql);
            $queryPrepared->execute($data);
    
            if ($return == "object") {
                return $queryPrepared->fetchObject(get_called_class()) ?: false;
            } else {
                return $queryPrepared->fetch(\PDO::FETCH_ASSOC) ?: false;
            }
        } catch (\PDOException $e) {
            error_log('Erreur SQL dans getOneBy : ' . $e->getMessage());
            return null; // Signale une erreur SQL
        }
    }


    public function findAll($sort = null, $order = null ): array|string
    {
        try {
            if ($sort && $order) {
                $query = $this->pdo->query("SELECT * FROM " . $this->table . " ORDER BY " . $sort . " " . $order);
            } else {
                $query = $this->pdo->query("SELECT * FROM " . $this->table);
            }
            return $query->fetchAll(\PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            return "Aucun article trouvé";
        }

    }

    public function CreateDB(){
        $tables = ["user", "pages"];
        try {
            foreach ($tables as $table) {
                $table = TABLE_PREFIX;
                $this->pdo->exec("DROP TABLE IF EXISTS $table CASCADE");
            }

            try {
                foreach ($tables as $table) {
                    $table = TABLE_PREFIX . $table;
                    if($table == TABLE_PREFIX . "user")
                    {
                        $sql = "
                                CREATE TABLE IF NOT EXISTS $table (
                                id SERIAL PRIMARY KEY,
                                firstname character varying(25) NOT NULL,
                                lastname character varying(50) NOT NULL,
                                email character varying(320) NOT NULL,
                                pwd character varying(255) NOT NULL,
                                role character varying(10) DEFAULT 'user' NOT NULL,
                                verification_token character varying(255),
                                email_verified boolean DEFAULT false,
                                date_inserted timestamptz DEFAULT CURRENT_TIMESTAMP,
                                date_updated timestamp,
                                isdeleted boolean DEFAULT false
                                )
                            ";
                        $this->pdo->exec($sql);
                    };
                    if ($table == TABLE_PREFIX . "pages")
                    {

                    }
                }
            } catch (\PDOException $e) {
                echo "Erreur lors de création des tables : " . $e->getMessage();
            } catch (\PDOException $e) {
                echo "Erreur lors de la suppression des tables : " . $e->getMessage();
            }
            catch (\PDOException $e) {
                echo "Erreur lors de création des tables : " . $e->getMessage();
            }


        } catch (\PDOException $e) {
            echo "Erreur lors de la suppression des tables : " . $e->getMessage();
        }
    }

    public function delete(): void
    {
        $sql = "DELETE FROM " . $this->table . " WHERE id = " . $this->getId();
        $queryPrepared = $this->pdo->prepare($sql);
        $queryPrepared->execute();
    }
}