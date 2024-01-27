<?php 

namespace App\Core;

use App\Controllers\EnvDecomposer;

class DB
{

    protected $pdo;
    protected string $table;
    private static $instance;
    private $table_prefix;


    public function __construct()
    {
        //Début pour récupérer le nom de la table en bdd
        // echo get_called_class();
        //connexion à la bdd via pdo
        $EnvDecomposer = new EnvDecomposer();
        $PdoString = $EnvDecomposer->getPdoString();
        $this->table_prefix = $EnvDecomposer->getTablePrefixString();
        try {
            $this->pdo = new \PDO($PdoString);
        } catch (\PDOException $e) {
            echo "Erreur SQL : " . $e->getMessage();
        }


        $table = get_called_class();
        $table = explode("\\", $table);
        $table = array_pop($table);
        $this->table = "esgi_" . strtolower($table);
        // echo "<pre>";
        // var_dump($this);
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

        // get_object_vars($this): cette fonction renvoie un tableau associatif contenant toutes les propriétés publiques, 
        // protégées et privées de l'objet représenté par `$this`. 
        // En d'autres termes, elle réupère les données de l'objet.

        // get_class_vars(get_class()) : Cette partie de la fonction récupère les propriétés de la classe. `get_class()` 
        // renroie le nom de la calsse de l'objet actuel, et `get_calss_vars()` revoie les propriétés de cette classe.

        // array_diff_key(): cette fonction compare les clés des deux tableaux fournis (le tableau des propiétées 
        // de l'objet et le tableau des propriétées de la classe) et renvoie un tableau contenant toutes les clés 
        // qui existent dans le premier tableau mais pas dans le seconde. En d'autre termes, elle retourne un tableau 
        // contenant les clés qui sont spécifique à l'objet et qui ne sont pas des propriétés de la classe.

        // var_dump(array_diff_key(get_object_vars($this), get_class_vars(get_class())));

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
            // echo $sql;
            // echo "<br>";
            $sql = substr($sql, 0, -1);
            $sql .= " WHERE id = " . $this->getId();
        }
        // echo $sql;
        // var_dump($data);
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


    public function findAll($sort = null, $order = null ): array
    {
        if ($sort && $order) {
            $query = $this->pdo->query("SELECT * FROM " . $this->table . " ORDER BY " . $sort . " " . $order);
        } else {
            $query = $this->pdo->query("SELECT * FROM " . $this->table);
        }
        return $query->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function CreateDB(){
        $tables = ["user"];
        try {
            foreach ($tables as $table) {
                $table = $this->table_prefix . $table;
                $this->pdo->exec("DROP TABLE IF EXISTS $table CASCADE");
            }

            try {
                foreach ($tables as $table) {
                    $table = $this->table_prefix . $table;
                    if($table == $this->table_prefix . "user")
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
                    }
                }
            }
            catch (\PDOException $e) {
                echo "Erreur lors de création des tables : " . $e->getMessage();
            }


        } catch (\PDOException $e) {
            echo "Erreur lors de la suppression des tables : " . $e->getMessage();
        }
    }
}