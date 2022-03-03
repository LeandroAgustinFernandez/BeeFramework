<?php

class testModel extends Model
{
    private $id;
    private $name;
    private $username;
    private $email;
    private $created_at;
    private $updated_at;

    public function getAll(){
        $sql = 'SELECT * FROM test';
        try {
            $datos = DB::query($sql);
            return $datos;
        } catch (PDOException $e) {
            throw $e->getMessage();
        }
    }

    public function add()
    {
        $sql = 'INSERT INTO test (name,username,email,created_at) VALUES (:name,:username,:email,:created_at)';
        $registro = [
            'name' => $this->name,
            'username' => $this->username,
            'email' => $this->email,
            'created_at' => $this->created_at
        ];
        try {
            return ($this->id = DB::query($sql, $registro)) ? $this->id : false;
        } catch (PDOException $e) {
            throw $e->getMessage();
        }
    }

    public function update()
    {
        $sql = 'UPDATE test SET name = :name, username = :username, email = :email WHERE id = :id';
        $registro = [
            'id'=>$this->id,
            'name' => $this->name,
            'username' => $this->username,
            'email' => $this->email,
            
        ];
        try {
            return (DB::query($sql, $registro)) ? true : false;
        } catch (PDOException $e) {
            throw $e->getMessage();
        }
    }

    public function getId(){return $this->id;}
    public function setId($id){$this->id = $id;}

    public function getName(){return $this->name;}
    public function setName($name){$this->name = $name;}

    public function getUsername(){return $this->username;}
    public function setUsername($username){$this->username = $username;}

    public function getEmail(){return $this->email;}
    public function setEmail($email){$this->email = $email;}

    public function getCreated_at(){return $this->created_at;}
    public function setCreated_at($created_at){$this->created_at = $created_at;}

    public function getUpdated_at(){return $this->updated_at;}
    public function setUpdated_at($updated_at){$this->updated_at = $updated_at;}
}
