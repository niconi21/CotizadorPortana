<?php

declare(strict_types=1);

class DataBase
{
    private $dbh = null;
    private $host = 'localhost';
    private $user = 'root';
    private $password = 'root';
    private $database = 'cotizador';

    function __construct()
    {
        try {
            $this->dbh = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->database, $this->user, $this->password);
            $this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $ex) {
            echo $ex;
        }
    }


    public function consultar(string $query, array $array)
    {
        try {
            $query = $this->dbh->prepare($query);
            $query->execute($array);
            $query =  $query->fetchAll(PDO::FETCH_OBJ);
            return array( 'ok' => true, 'result'=> $query);
        } catch (\PDOException $th) {
            return array('ok' => false, 'error' => $th);
        }
    }

    public function insertar_actuallzar_eliminar($query, $array): array
    {
        try {
            $query = $this->dbh->prepare($query);
            $query->execute($array);
            return array('ok' => true);
        } catch (\PDOException $th) {
            return array('ok' => false, 'error' => $th);
        }
    }
}
