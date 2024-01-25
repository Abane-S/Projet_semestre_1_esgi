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
    protected int $role;
    protected String $verification_token;
    protected Int $email_verified;
    protected $date_inserted;
    protected $date_updated;
    protected int $isdeleted;

    
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

    /**
     * Get the value of role
     */ 
    public function getRole()
    {
        return $this->role;
    }

    /**
     * Set the value of role
     *
     * @return  self
     */ 
    public function setRole(int $role)
    {
        $this->role = $role;

        
    }

    /**
     * Get the value of isDeleted
     */ 
    public function getIsDeleted()
    {
        return $this->isDeleted;
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


    public function setIsDeleted(bool $isdeleted)
    {
        $this->isDeleted = $isdeleted;
    }

    public function getEmailverify($email) : bool
    {
        $sql = "SELECT email_verified FROM users WHERE email = :email";
        $queryPrepared = $this->pdo->prepare($sql);
        $queryPrepared->execute(['email' => $email]);
        $result = $queryPrepared->fetch();
        return $result['email_verified'];
    }

    public function getAccountisDeleted($email): bool
    {
        $sql = "SELECT isdeleted FROM users WHERE email = :email";
        $queryPrepared = $this->pdo->prepare($sql);
        $queryPrepared->execute(['email' => $email]);
        $result = $queryPrepared->fetch();
        return $result['isdeleted'];
    }
}
