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


    public function isValid(): bool
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

    public function checkEmail($email): bool
    {
        $filterMail = filter_var($email, FILTER_VALIDATE_EMAIL);
        return $filterMail;
    }

    public function checkPassword($password): bool
    {
        return preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_])/", $password);
    }
    
    public function checkName($Name): bool
    {
        return preg_match("/^[a-zA-Z]{2,45}$/", $Name);
    }

    public function checkIdentical($field1, $field2): bool
    {
        return $field1 == $field2;
    }
}
