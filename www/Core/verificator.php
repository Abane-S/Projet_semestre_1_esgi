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
            die("Tentative de Hack");
        }
        foreach ($this->config["inputs"] as $name => $input) {
            if (empty($this->data[$name])) {
                die("Tentative de Hack 2");
            }

            if ($input["type"] == "email" && !$this->checkEmail($this->data[$name]) && $name != "user_confirm_email") {
                $this->listOfErrors[] = $input["error"];
            }

            if ($input["type"] == "password" && !($this->checkPassword($this->data[$name])) && $name != "user_confirm_password") {
                $this->listOfErrors[] = $input["error"];
            }

            if ($input["type"] == "text" && !($this->checkFirstName($this->data[$name])) && $name != "user_lastname") {
                $this->listOfErrors[] = $input["error"];
            }

            if ($input["type"] == "text" && !($this->checkLastName($this->data[$name])) && $name != "user_firstname") {
                $this->listOfErrors[] = $input["error"];
            }

            if ($input["type"] == "email" && !$this->checkConfirmEmail($this->data["user_email"],  $this->data[$name])) {
                $this->listOfErrors[] = $input["error"];
            }

            if ($input["type"] == "password" && !$this->checkConfirmPassword($this->data["user_password"], $this->data[$name])) {
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
        $pregMail = preg_match("/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/", $email);
        return $filterMail && $pregMail;
    }

    public function checkPassword($password): bool
    {
        return preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*()])[a-zA-Z\d!@#$%^&*()]{8,45}$/", $password);
    }

    public function checkFirstName($firstName): bool
    {
        return preg_match("/^[a-zA-Z]{2,45}$/", $firstName);
    }

    public function checkLastName($lastName): bool
    {
        return preg_match("/^[a-zA-Z]{2,45}$/", $lastName);
    }

    public function checkUsername($username): bool
    {
        return preg_match("/^[a-zA-Z0-9\s-]{2,45}+$/", $username);
    }

    public function checkConfirmEmail($email, $confirmEmail): bool
    {
        return $email == $confirmEmail;
    }

    public function checkConfirmPassword($password, $confirmPassword): bool
    {
        return $password == $confirmPassword;
    }

}
