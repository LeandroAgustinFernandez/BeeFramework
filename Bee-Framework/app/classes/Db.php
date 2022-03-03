<?php
class DB
{
    private $link;
    private $engine;
    private $host;
    private $name;
    private $user;
    private $pass;
    private $charset;
    private $port;

    /** 
     * Metodo constructor
     */
    public function __construct()
    {
        $this->engine = IS_LOCAL ? LDB_ENGINE : DB_ENGINE;
        $this->host = IS_LOCAL ? LDB_HOST : DB_HOST;
        $this->name = IS_LOCAL ? LDB_NAME : DB_NAME;
        $this->user = IS_LOCAL ? LDB_USER : DB_USER;
        $this->pass = IS_LOCAL ? LDB_PASS : DB_PASS;
        $this->charset = IS_LOCAL ? LDB_CHARSET : DB_CHARSET;
        $this->port = IS_LOCAL ? LDB_PORT : DB_PORT;
        return $this;
    }

    /** 
     * Metodo para abrir una conexion a la base de datos
     * 
     * @return void
     */
    private function connect()
    {
        try {
            $this->link = new PDO($this->engine . ':host=' . $this->host . ';dbname=' . $this->name . ';port=' . $this->port . ';charset=' . $this->charset, $this->user, $this->pass);
            return $this->link;
        } catch (PDOException $e) {
            die(sprintf('No hay conexion a la base de datos, hubo un error: %s', $e->getMessage()));
        }
    }

    /** 
     * Metodo para hacer un query a la base de datos
     * 
     * @param string $sql
     * @param array $params
     * @return void
     */
    public static function query($sql, $params = [])
    {
        $db = new self();
        $link = $db->connect(); // conexion a la DB
        $link->beginTransaction(); // Por cualquier error, checkpoint
        $query = $link->prepare($sql);

        // Manejando ejecucion del query o la peticion, si huvo errores.
        if (!$query->execute($params)) {
            $link->rollBack();
            $error = $query->errorInfo();
            // index 0 es el tipo de error
            // index 1 es el codigo de error
            // index 2 es el mensaje de error
            throw new Exception($error[2]);
        }

        //Manejador de tipo de query; Manejo de resultados
        if (strpos($sql, 'SELECT') !== false) {
            return $query->rowCount() > 0 ? $query->fetchAll() : false;
        } elseif (strpos($sql, 'INSERT') !== false) {
            $id = $link->lastInsertId();
            $link->commit();
            return $id;
        } elseif (strpos($sql, 'UPDATE') !== false) {
            $link->commit();
            return true;
        } elseif (strpos($sql, 'DELETE') !== false) {
            if ($query->rowCount() > 0) {
                $link->commit();
                return true;
            }
            $link->rollBack();
            return false;
        } else {
            $link->commit();
            return false;
        }
    }
}
