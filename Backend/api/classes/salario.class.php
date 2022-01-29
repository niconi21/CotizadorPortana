<?php

declare(strict_types=1);
include('database.db.php');


class Salario
{
    private $_dbh = null;

    public function __construct()
    {
        $this->_dbh = new DataBase();
    }

    public function obtenerSalarios($limit, $skip)
    {
        echo $limit;
        $result = $this->_dbh->consultar('SELECT * FROM Salario limit '.$skip.', '.$limit, []);

        if ($result['ok']) {
            echo  json_encode(array(
                "ok" => $result['ok'],
                "result" => $result['result']
            ));
        } else {
            echo  json_encode(array(
                "ok" => $result['ok'],
                "message" => 'No hay salarios',
                "error" => $result['error'],
            ));
        }
    }
    
    public function insertarSalario($nombre, $cantidad)
    {
        $result = $this->_dbh->insertar_actuallzar_eliminar('INSERT INTO Salario VALUES (0, ?, ?)', [$nombre, $cantidad]);

        if ($result['ok']) {
            echo  json_encode(array(
                "ok" => $result['ok'],
                "message" => 'Salario guardado'
            ));
        } else {
            echo  json_encode(array(
                "ok" => $result['ok'],
                "message" => 'Error al guardar el salario',
                "error" => $result['error']
            ));
        }
    }

    public function actualizarSalario($id, $nombre, $cantidad)
    {
        $result = $this->_dbh->insertar_actuallzar_eliminar('UPDATE Salario SET nombre = ?, cantidad = ? WHERE id = ?', [$nombre, $cantidad, $id]);

        if ($result['ok']) {
            echo  json_encode(array(
                "ok" => $result['ok'],
                "message" => 'Salario actualizado'
            ));
        } else {
            echo  json_encode(array(
                "ok" => $result['ok'],
                "message" => 'Error al actualizar el salario',
                "error" => $result['error']
            ));
        }
    }
}
