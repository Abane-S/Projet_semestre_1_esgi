<?php


namespace App\Models;

use App\Core\DB;

class User extends DB
{
    private ?int $id = null;
    protected string $firstname;
    protected string $lastname;
    protected string $email;
    protected string $pwd;
    protected string $role;

    protected String $verification_token;
    protected Int $email_verified;
    protected $date_inserted;
    protected $date_updated;
    protected int $isdeleted;

    public function getRole(): string
    {
        return $this->role;
    }

    public function setRole(string $role): void
    {
        $this->role = $role;
    }

    public function getIsdeleted(): int
    {
        return $this->isdeleted;
    }

    public function setIsdeleted(int $isdeleted): void
    {
        $this->isdeleted = $isdeleted;
    }

    
    public function __toString()
    {
        return $this->getFirstname()." ".$this->getLastname();
    }

    

    /**
     * Get the value of id
     */ 
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        
    }

    /**
     * Get the value of firstname
     */ 
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set the value of firstname
     *
     * @return  self
     */ 
    public function setFirstname(string $firstname)
    {
        $firstname = ucwords(strtolower(trim($firstname)));
        $this->firstname = $firstname;

        
    }

    /**
     * Get the value of lastname
     */ 
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Set the value of lastname
     *
     * @return  self
     */ 
    public function setLastname(string $lastname)
    {
        $lastname = strtoupper(trim($lastname));
        $this->lastname = $lastname;

        
    }

    public function setEmail(string $email):void
    {
        $email = strtolower(trim($email));
        $this->email = $email;
    }

    /**
     * Get the value of pwd
     */ 
    public function getPassword()
    {
        return $this->pwd;
    }

    /**
     * Set the value of pwd
     *
     * @return  self
     */ 
    public function setPassword($pwd)
    {
        $pwd = password_hash($pwd, PASSWORD_DEFAULT);
        $this->pwd = $pwd;
    }

    public function getVericationToken(): int
    {
        return $this->verification_token;
    }

    /**
     * @param int $verification_token
     */
    public function setVericationToken(String $verification_token): void
    {
        $this->verification_token = $verification_token;
    }

    /**
     * @return int
     */
    public function getEmailVerified(): int
    {
        return $this->email_verified;
    }

    /**
     * @param int $email_verified
     */
    public function setEmailVerified(int $email_verified): void
    {
        $this->email_verified = $email_verified;
    }

    /**
     * @return mixed
     */
    public function getinsertedat(): mixed
    {
        return $this->date_inserted;
    }

    /**
     * @param mixed $date_inserted
     */
    public function setinsertedat($date_inserted): void
    {
        $this->date_inserted = $date_inserted;
    }

    /**
     * @return mixed
     */
    public function getupdatedat(): mixed
    {
        return $this->date_updated;
    }

    /**
     * 
     * @param mixed $date_updated
     */
    public function setupdatedat($date_updated): void
    {
        $this->date_updated = $date_updated;
    }

    public function HardDeleteAccount($email): bool
    {
        try {
            // Perform the hard delete operation
            $sql = "DELETE FROM " . $this->table . " WHERE email = :email";
            $queryPrepared = $this->pdo->prepare($sql);
            $queryPrepared->execute(['email' => $email]);

            // Check if any rows were affected
            $rowCount = $queryPrepared->rowCount();

            return $rowCount > 0;
        } catch (\PDOException $e) {
            return false;
        }
    }


}
