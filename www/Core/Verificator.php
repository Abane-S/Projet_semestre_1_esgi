<?php

namespace App\Core;

class Verificator {


    public array $data = [];

    public array $listOfErrors = [];


    public function isSubmit(): bool
    {
        $this->data = ($this->method == "POST")?$_POST:$_GET;
        if(isset($this->data["submit"])){
            return true;
        }
        return false;
    }

    public function isValidEmail(): bool
    {
        if (count($this->config["inputs"]) != count($this->data) - 1) {
            die("Tentative de Hack 1");
        }
        foreach ($this->config["inputs"] as $name => $input) {
            if (empty($this->data[$name])) {
                die("Tentative de Hack 2");
            }

            if (!$this->checkIdentical($this->data["csrf_token"], $_SESSION['csrf_token'])) {
                die("Tentative de Hack 3");
            }

            if ($name == "contact_subject" && $input["type"] == "text" && !($this->checkSubject($this->data[$name]))) {
                $this->listOfErrors[] = $input["error"];
            }

            if ($name == "contact_message" && $input["type"] == "text" && !($this->checkMessage($this->data[$name]))) {
                $this->listOfErrors[] = $input["error"];
            }
        }
        if(empty($this->listOfErrors)){
            return true;
        }
        return false;
    }

    public function isValidAccountModification(): bool
    {
        if (count($this->config["inputs"]) != count($this->data) - 1) {
            die("Tentative de Hack 1");
        }
        foreach ($this->config["inputs"] as $name => $input) {
            if (!$this->checkIdentical($this->data["csrf_token"], $_SESSION['csrf_token'])) {
                die("Tentative de Hack 3");
            }

            if(!empty($this->data[$name])
            )
            {
                if ($input["type"] == "password" && !($this->checkPassword($this->data[$name])) && $name != "user_confirm_password") {
                    $this->listOfErrors[] = $input["error"];
                }

                if ($input["type"] == "text" && !($this->checkName($this->data[$name])) && $name != "user_lastname") {
                    $this->listOfErrors[] = $input["error"];
                }

                if ($input["type"] == "text" && !($this->checkName($this->data[$name])) && $name != "user_firstname") {
                    $this->listOfErrors[] = $input["error"];
                }

                if ($input["type"] == "password" && !$this->checkIdentical($this->data["user_password"], $this->data[$name])) {
                    $this->listOfErrors[] = $input["error"];
                }
            }
            if(empty($this->data["user_confirm_password"]) && !empty($this->data["user_password"]))
            {
                if ($input["type"] == "password" && !$this->checkIdentical($this->data["user_password"], $this->data[$name])) {
                    $this->listOfErrors[] = $input["error"];
                }
            }
        }
        if(empty($this->listOfErrors)){
            return true;
        }
        return false;
    }

    public function isValid(): bool
    {

        if (count($this->config["inputs"]) + count($this->config["select"] ?? []) != count($this->data) - 1) {
            die("Tentative de Hack 1");
        }
        foreach ($this->config["inputs"] as $name => $input) {
            if (empty($this->data[$name])) {
                die("Tentative de Hack 2");
            }

            if (!$this->checkIdentical($this->data["csrf_token"], $_SESSION['csrf_token'])) {
                var_dump($this->data["csrf_token"]);
                die("Tentative de Hack 3");
            }

            if ($input["type"] == "email" && !$this->checkEmail($this->data[$name]) && $name != "user_confirm_email") {
                $this->listOfErrors[] = $input["error"];
            }


            if ($input["type"] == "password" && !($this->checkPassword($this->data[$name])) && $name != "user_confirm_password") {
                $this->listOfErrors[] = $input["error"];
            }

            if ($input["type"] == "text" && !($this->checkName($this->data[$name])) && $name != "user_lastname") {
                $this->listOfErrors[] = $input["error"];
            }

            if ($input["type"] == "text" && !($this->checkName($this->data[$name])) && $name != "user_firstname") {
                $this->listOfErrors[] = $input["error"];
            }

            if ($input["type"] == "email" && !$this->checkIdentical($this->data["user_email"],  $this->data[$name])) {
                $this->listOfErrors[] = $input["error"];
            }

            if ($input["type"] == "password" && !$this->checkIdentical($this->data["user_password"], $this->data[$name])) {
                $this->listOfErrors[] = $input["error"];
            }
        }
        if(empty($this->listOfErrors)){
            return true;
        }
        return false;
    }


    public function isValidComment(): bool
    {
        if (count($this->config["inputs"]) != count($this->data) - 1) {
            die("Tentative de Hack 1");
        }
        foreach ($this->config["inputs"] as $name => $input) {
            if (empty($this->data[$name])) {
                die("Tentative de Hack 2");
            }

            if (!$this->checkIdentical($this->data["csrf_token"], $_SESSION['csrf_token'])) {
                die("Tentative de Hack 3");
            }

            if ($name == "comment_title" && $input["type"] == "text" && !($this->checkCommentTitle($this->data[$name]))) {
                $this->listOfErrors[] = $input["error"];
            }

            if ($name == "comment" && $input["type"] == "text" && !($this->checkComment($this->data[$name]))) {
                $this->listOfErrors[] = $input["error"];
            }
        }
        if(empty($this->listOfErrors)){
            return true;
        }
        return false;
    }

    public function isValidCommentUpdate(): bool
    {
        if (count($this->config["inputs"]) + count($this->config["select"]) != count($this->data) - 1) {
            die("Tentative de Hack 1");
        }
        foreach ($this->config["inputs"] as $name => $input) {
            if (empty($this->data[$name])) {
                die("Tentative de Hack 2");
            }

            if (!$this->checkIdentical($this->data["csrf_token"], $_SESSION['csrf_token'])) {
                die("Tentative de Hack 3");
            }

            if ($name == "comment_title" && $input["type"] == "text" && !($this->checkCommentTitle($this->data[$name]))) {
                $this->listOfErrors[] = $input["error"];
            }

            if ($name == "comment" && $input["type"] == "text" && !($this->checkComment($this->data[$name]))) {
                $this->listOfErrors[] = $input["error"];
            }

        }
        foreach ($this->config["select"] as $name => $input) {
            if ($name == "comment_valid" && !($this->checkValidBool($this->data[$name]))) {
                $this->listOfErrors[] = $input["error"];
            }
        }
        if(empty($this->listOfErrors)){
            return true;
        }
        return false;
    }

    public function isValidUserCreation(): bool
    {
        if (count($this->config["inputs"]) + count($this->config["select"] ?? []) != count($this->data) - 1) {
            die("Tentative de Hack 1");
        }
        foreach ($this->config["inputs"] as $name => $input) {
            if (empty($this->data[$name])) {
                die("Tentative de Hack 2");
            }

            if (!$this->checkIdentical($this->data["csrf_token"], $_SESSION['csrf_token'])) {
                die("Tentative de Hack 3");
            }

            if ($input["type"] == "email" && !$this->checkEmail($this->data[$name]) && $name != "user_confirm_email") {
                $this->listOfErrors[] = $input["error"];
            }


            if ($input["type"] == "password" && !($this->checkPassword($this->data[$name])) && $name != "user_confirm_password") {
                $this->listOfErrors[] = $input["error"];
            }

            if ($input["type"] == "text" && !($this->checkName($this->data[$name])) && $name != "user_lastname") {
                $this->listOfErrors[] = $input["error"];
            }

            if ($input["type"] == "text" && !($this->checkName($this->data[$name])) && $name != "user_firstname") {
                $this->listOfErrors[] = $input["error"];
            }

            if ($input["type"] == "email" && !$this->checkIdentical($this->data["user_email"],  $this->data[$name])) {
                $this->listOfErrors[] = $input["error"];
            }

            if ($input["type"] == "password" && !$this->checkIdentical($this->data["user_password"], $this->data[$name])) {
                $this->listOfErrors[] = $input["error"];
            }
        }

        foreach ($this->config["select"] as $name => $input) {
            if ($name == "role" && !($this->checkValidRole($this->data[$name]))) {
                $this->listOfErrors[] = $input["error"];
            }
        }

        if(empty($this->listOfErrors)){
            return true;
        }
        return false;
    }

    public function isValidInstall(): bool
    {
        if (count($this->config["inputs"]) + count($this->config["select"]) != count($this->data)) {
            die("Tentative de Hack 1");
        }
        foreach ($this->config["inputs"] as $name => $input) {
            if($name != "site_img") {
                if (empty($this->data[$name])) {
                    die("Tentative de Hack 2");
                }
            }

            if (!$this->checkIdentical($this->data["csrf_token"], $_SESSION['csrf_token'])) {
                die("Tentative de Hack 3");
            }

            if($name != "admin_firstname" && $name != "admin_lastname" && $name != "admin_email" && $name != "admin_confirm_email" && $name != "admin_password" && $name != "admin_confirm_password" && $name != "smtp_host" && $name != "smtp_port" && $name != "smtp_email" && $name != "smtp_confirm_email" && $name != "smtp_password" && $name != "smtp_confirm_password" && $name != "smtp_username" && $name != "smtp_name" && $name != "site_name" && $name != "site_img") {
                if ($name == "db_name" && $input["type"] == "text" && !$this->checkDBUsername2($this->data["db_name"])) {
                    $this->listOfErrors[] = $input["error"];
                }

                if ($name == "db_hote" && $input["type"] == "text" && !$this->checkDBUsername2($this->data["db_hote"])) {
                    $this->listOfErrors[] = $input["error"];
                }

                if ($name == "db_username" && $input["type"] == "text" && !$this->checkDBUsername($this->data["db_username"])) {
                    $this->listOfErrors[] = $input["error"];
                }

                if ($name == "db_port" && $input["type"] == "text" && !$this->checkPort($this->data["db_port"])) {
                    $this->listOfErrors[] = $input["error"];
                }

                if ($name == "db_table_prefix" && $input["type"] == "text" && !$this->checkTablePrefix($this->data["db_table_prefix"])) {
                    $this->listOfErrors[] = $input["error"];
                }

                if ($input["type"] == "password" && !($this->checkPassword($this->data[$name])) && $name != "db_confirm_password") {
                    $this->listOfErrors[] = $input["error"];
                }

                if ($input["type"] == "password" && !$this->checkIdentical($this->data["db_password"], $this->data[$name])) {
                    $this->listOfErrors[] = $input["error"];
                }
            }
            else if($name == "admin_firstname" || $name == "admin_lastname" || $name == "admin_email" || $name == "admin_confirm_email" || $name == "admin_password" || $name == "admin_confirm_password") {
                if ($input["type"] == "email" && !$this->checkEmail($this->data[$name]) && $name != "admin_confirm_email") {
                    $this->listOfErrors[] = $input["error"];
                }


                if ($input["type"] == "password" && !($this->checkPassword($this->data[$name])) && $name != "admin_confirm_password") {
                    $this->listOfErrors[] = $input["error"];
                }

                if ($input["type"] == "text" && !($this->checkName($this->data[$name])) && $name != "admin_lastname") {
                    $this->listOfErrors[] = $input["error"];
                }

                if ($input["type"] == "text" && !($this->checkName($this->data[$name])) && $name != "admin_firstname") {
                    $this->listOfErrors[] = $input["error"];
                }

                if ($input["type"] == "email" && !$this->checkIdentical($this->data["admin_email"], $this->data[$name])) {
                    $this->listOfErrors[] = $input["error"];
                }

                if ($input["type"] == "password" && !$this->checkIdentical($this->data["admin_password"], $this->data[$name])) {
                    $this->listOfErrors[] = $input["error"];
                }
            }
            else if($name == "site_name" || $name == "site_img"){
                if ($input["type"] == "text" && !($this->checkSiteName($this->data[$name]))) {
                    $this->listOfErrors[] = $input["error"];
                }

                if(!empty($this->data["site_img"])) {
                    if ($input["type"] == "file" && !($this->checkImg($this->data[$name]))) {
                        $this->listOfErrors[] = $input["error"];
                    }
                }
            }
            else if (
                $name == "smtp_host" ||
                $name == "smtp_port" ||
                $name == "smtp_email" ||
                $name == "smtp_confirm_email" ||
                $name == "smtp_password" ||
                $name == "smtp_confirm_password" ||
                $name == "smtp_username" ||
                $name == "smtp_name"
            ){
                if ($input["type"] == "email" && !$this->checkEmail($this->data[$name]) && $name != "smtp_confirm_email") {
                    $this->listOfErrors[] = $input["error"];
                }

                if ($input["type"] == "password" && !($this->checkPassword($this->data[$name])) && $name != "smtp_confirm_password") {
                    $this->listOfErrors[] = $input["error"];
                }


                if ($input["type"] == "email" && !$this->checkIdentical($this->data["smtp_email"], $this->data[$name])) {
                    $this->listOfErrors[] = $input["error"];
                }

                if ($input["type"] == "password" && !$this->checkIdentical($this->data["smtp_password"], $this->data[$name])) {
                    $this->listOfErrors[] = $input["error"];
                }

                if ($name == "smtp_port" && $input["type"] == "text" && !$this->checkPort($this->data["smtp_port"])) {
                    $this->listOfErrors[] = $input["error"];
                }

                if ($name == "smtp_name" && $input["type"] == "text" && !($this->checkName($this->data[$name]))) {
                    $this->listOfErrors[] = $input["error"];
                }

                if ($name == "smtp_username" && $input["type"] == "text" && !($this->checkDBUsername($this->data[$name]))) {
                    $this->listOfErrors[] = $input["error"];
                }

                if ($name == "smtp_host" && $input["type"] == "text" && !($this->checkSMTPHost($this->data[$name]))) {
                    $this->listOfErrors[] = $input["error"];
                }

            }

        }
        foreach ($this->config["select"] as $name => $input) {
            if ($name == "db_engine" && !($this->checkValidPDO($this->data[$name]))) {
                $this->listOfErrors[] = $input["error"];
            }
        }
        if(empty($this->listOfErrors)){
            return true;
        }
        return false;
    }

    public function isValidDelete(): bool
    {
        if (count($this->config["inputs"]) + count($this->config["select"]) != count($this->data) - 1) {
            die("Tentative de Hack 1");
        }
        foreach ($this->config["inputs"] as $name => $input) {
            if (empty($this->data[$name])) {
                die("Tentative de Hack 2");
            }

            if (!$this->checkIdentical($this->data["csrf_token"], $_SESSION['csrf_token'])) {
                die("Tentative de Hack 3");
            }

        }
        if(empty($this->listOfErrors)){
            return true;
        }
        return false;
    }

    public function checkEmail($email): bool
    {
        $filterMail = filter_var($email, FILTER_VALIDATE_EMAIL);
        return $filterMail;
    }

    function checkValidPDO($chaine) {
        return preg_match("/^(pgsql|mysql|sqlsrv|oracle|cubrid|odbc|firebird)$/", $chaine);
    }

    function checkValidRole($chaine) {
        return preg_match("/^(user|moderateur)$/", $chaine);
    }

    public function checkPassword($password): bool
    {
        return preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_])/", $password);
    }
    
    public function checkName($name): bool
    {
        return preg_match("/^[a-zA-Z]{2,45}$/", $name);
    }

    public function checkSiteName($name): bool
    {
        return preg_match("/^[a-zA-Z0-9\-_\. ]{3,50}$/", $name);
    }

    function checkValidBool($valeur) {
        return preg_match('/^[01]$/', $valeur) === 1;
    }

    public function checkImg($img): bool
    {
        return preg_match("/\.png$|\.jpeg$|\.jpg$|\.gif$/i", $img);
    }

    public function checkComment($texte): bool
    {
        return preg_match("/^.{1,600}$/", $texte);
    }

    public function checkCommentTitle($texte): bool
    {
        return preg_match("/^.{1,60}$/", $texte);
    }

public function checkDBUsername($name): bool
    {
        return preg_match("/^[a-zA-Z0-9_]{3,20}$/", $name);
    }

    public function checkDBUsername2($name): bool
    {
        return preg_match("/^[a-zA-Z0-9_]{1,64}$/", $name);
    }

    public function checkPort($port): bool
    {
        return preg_match('/^((6553[0-5])|(655[0-2][0-9])|(65[0-4][0-9]{2})|(6[0-4][0-9]{3})|([1-5][0-9]{4})|([0-5]{0,5})|([0-9]{1,4}))$/', $port);
    }

    public function checkSMTPHost($host): bool
    {
        return preg_match('/^[\w.-]{2,50}$/', $host);
    }

    public function checkSubject($subject): bool
    {
        return preg_match('/^.{1,255}$/', $subject);
    }

    public function checkMessage($msg): bool
    {
        return preg_match('/^.{1,10000}$/', $msg);
    }

    public function checkTablePrefix($prefix): bool
    {
        return preg_match("/^[a-zA-Z][a-zA-Z_]{1,6}$/", $prefix);
    }

    public function checkIdentical($field1, $field2): bool
    {
        return $field1 == $field2;
    }
}
