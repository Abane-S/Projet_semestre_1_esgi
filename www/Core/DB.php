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

        $this->table = "esgi_" . strtolower($table);

        // Vérifier si la base de données est vide 

        // Vérifier si la base de données est vide

        $checkTablesQuery = $this->pdo->prepare("
            SELECT EXISTS (
                SELECT 1
                FROM information_schema.tables
                WHERE table_schema = 'public'
            )
        ");
        $checkTablesQuery->execute();
        $tableExists = $checkTablesQuery->fetchColumn();

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
                    };
                    if ($table == $this->table_prefix . "pages")
                    {
                        $sql = "
                                DROP TABLE IF EXISTS 'esgi_pages';
                                DROP SEQUENCE IF EXISTS esgi_pages_id_seq;
                                CREATE SEQUENCE esgi_pages_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 2147483647 CACHE 1;
                                
                                CREATE TABLE 'public'.'esgi_pages' (
                                    'id' integer DEFAULT nextval('esgi_pages_id_seq') NOT NULL,
                                    'title' character varying(255) NOT NULL,
                                    'content' text,
                                    'user_id' integer NOT NULL,
                                    'date_created' timestamp DEFAULT CURRENT_TIMESTAMP,
                                    'date_modified' timestamp,
                                    'url_page' text,
                                    'controller_page' character varying(255) NOT NULL,
                                    'action_page' character varying(255) NOT NULL,
                                    'used_template' character varying(255),
                                    CONSTRAINT 'esgi_pages_pkey' PRIMARY KEY ('id')
                                ) WITH (oids = false);
                                INSERT INTO 'esgi_pages' ('id', 'title', 'content', 'user_id', 'date_created', 'date_modified', 'url_page', 'controller_page', 'action_page', 'used_template') VALUES
                                (2,	'dashboard',	'{'type':'body','children':[{'type':'img','attributes':{'src':'ImagePage\\/Uploads\\/ded\\/ded+logo fla.png'}},'dedLa FLA a permis de jouer contre de nombreuse equipe lors d\''un tournoi']}',	126,	'2023-06-28 09:35:28.62323',	NULL,	'/dashboard',	'Main',	'dashboard',	NULL),
                                (3,	'contact',	'{'type':'body','children':[{'type':'img','attributes':{'src':'ImagePage\\/Uploads\\/ded\\/ded+logo fla.png'}},'dedLa FLA a permis de jouer contre de nombreuse equipe lors d\''un tournoi']}',	126,	'2023-06-28 09:36:18.308916',	NULL,	'/contact',	'Main',	'contact',	NULL),
                                (4,	'login',	'{'type':'body','children':[{'type':'img','attributes':{'src':'ImagePage\\/Uploads\\/ded\\/ded+logo fla.png'}},'dedLa FLA a permis de jouer contre de nombreuse equipe lors d\''un tournoi']}',	126,	'2023-06-28 09:36:52.399549',	NULL,	'/login',	'Security',	'login',	NULL),
                                (5,	'logout',	'{'type':'body','children':[{'type':'img','attributes':{'src':'ImagePage\\/Uploads\\/ded\\/ded+logo fla.png'}},'dedLa FLA a permis de jouer contre de nombreuse equipe lors d\''un tournoi']}',	126,	'2023-06-28 09:37:34.418299',	NULL,	'/logout',	'Security',	'logout',	NULL),
                                (7,	'disconnect',	'{'type':'body','children':[{'type':'img','attributes':{'src':'ImagePage\\/Uploads\\/ded\\/ded+logo fla.png'}},'dedLa FLA a permis de jouer contre de nombreuse equipe lors d\''un tournoi']}',	126,	'2023-06-28 09:39:12.302641',	NULL,	'/disconnect',	'Security',	'disconnect',	NULL),
                                (8,	'verify',	'{'type':'body','children':[{'type':'img','attributes':{'src':'ImagePage\\/Uploads\\/ded\\/ded+logo fla.png'}},'dedLa FLA a permis de jouer contre de nombreuse equipe lors d\''un tournoi']}',	126,	'2023-06-28 09:39:30.914361',	NULL,	'/verify',	'Security',	'verify',	NULL),
                                (96,	'install',	'{'type':'body','children':[{'type':'img','attributes':{'src':'ImagePage\\/Uploads\\/ded\\/ded+logo fla.png'}},'dedLa FLA a permis de jouer contre de nombreuse equipe lors d\''un tournoi']}',	126,	'2023-09-16 06:17:15.241603',	NULL,	'/install',	'Admin',	'install',	NULL),
                                (12,	'delete_user',	'{'type':'body','children':[{'type':'img','attributes':{'src':'ImagePage\\/Uploads\\/ded\\/ded+logo fla.png'}},'dedLa FLA a permis de jouer contre de nombreuse equipe lors d\''un tournoi']}',	127,	'2023-06-28 12:45:14.6325',	NULL,	'/admin/delete_user',	'Admin',	'deleteUser',	NULL),
                                (11,	'edit_user',	'{'type':'body','children':[{'type':'img','attributes':{'src':'ImagePage\\/Uploads\\/ded\\/ded+logo fla.png'}},'dedLa FLA a permis de jouer contre de nombreuse equipe lors d\''un tournoi']}',	127,	'2023-06-28 12:44:33.291857',	NULL,	'/admin/edit_user',	'Admin',	'editUser',	NULL),
                                (100,	'ded',	'{'type':'body','children':[{'type':'img','attributes':{'src':'ImagePage\\/Uploads\\/ded\\/ded+logo fla.png'}},'dedLa FLA a permis de jouer contre de nombreuse equipe lors d\''un tournoi']}',	126,	'2023-09-18 14:42:54',	NULL,	'/ded',	'Page',	'index',	'Article'),
                                (13,	'add_template_page',	'{'type':'body','children':[{'type':'img','attributes':{'src':'ImagePage\\/Uploads\\/ded\\/ded+logo fla.png'}},'dedLa FLA a permis de jouer contre de nombreuse equipe lors d\''un tournoi']}',	126,	'2023-06-28 14:24:41.937919',	NULL,	'/add_template_page',	'Security',	'addTemplatePage',	NULL),
                                (14,	'Index',	'{'type':'body','children':[{'type':'img','attributes':{'src':'ImagePage\\/Uploads\\/ded\\/ded+logo fla.png'}},'dedLa FLA a permis de jouer contre de nombreuse equipe lors d\''un tournoi']}',	126,	'2023-06-29 06:56:39.827372',	NULL,	'/',	'Main',	'index',	NULL),
                                (6,	'register',	'{'type':'body','children':[{'type':'img','attributes':{'src':'ImagePage\\/Uploads\\/ded\\/ded+logo fla.png'}},'dedLa FLA a permis de jouer contre de nombreuse equipe lors d\''un tournoi']}',	126,	'2023-06-28 09:38:51.893301',	NULL,	'/register',	'Security',	'register',	NULL),
                                (15,	'components',	'{'type':'body','children':[{'type':'img','attributes':{'src':'ImagePage\\/Uploads\\/ded\\/ded+logo fla.png'}},'dedLa FLA a permis de jouer contre de nombreuse equipe lors d\''un tournoi']}',	127,	'2023-06-30 09:45:46.514237',	NULL,	'/components',	'Main',	'components',	NULL),
                                (9,	'Choice Template Page',	'{'type':'body','children':[{'type':'img','attributes':{'src':'ImagePage\\/Uploads\\/ded\\/ded+logo fla.png'}},'dedLa FLA a permis de jouer contre de nombreuse equipe lors d\''un tournoi']}',	126,	'2023-06-28 12:39:00.307211',	NULL,	'/choice_template_page',	'Security',	'choiceTemplatePage',	NULL),
                                (16,	'Create Page',	'{'type':'body','children':[{'type':'img','attributes':{'src':'ImagePage\\/Uploads\\/ded\\/ded+logo fla.png'}},'dedLa FLA a permis de jouer contre de nombreuse equipe lors d\''un tournoi']}',	126,	'2023-06-30 14:10:21.927364',	NULL,	'/create_page',	'Security',	'createPage',	NULL),
                                (72,	'page',	'{'type':'body','children':[{'type':'img','attributes':{'src':'ImagePage\\/Uploads\\/ded\\/ded+logo fla.png'}},'dedLa FLA a permis de jouer contre de nombreuse equipe lors d\''un tournoi']}',	126,	'2023-07-21 01:26:14.765273',	NULL,	'/page',	'Security',	'page',	NULL),
                                (76,	'delete_page',	'{'type':'body','children':[{'type':'img','attributes':{'src':'ImagePage\\/Uploads\\/ded\\/ded+logo fla.png'}},'dedLa FLA a permis de jouer contre de nombreuse equipe lors d\''un tournoi']}',	127,	'2023-06-28 12:45:14.6325',	NULL,	'/admin/delete_page',	'Admin',	'deletePage',	NULL);
                            ";
                        $this->pdo->exec($sql);
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
}