<?php

declare(strict_types=1);
include('database.db.php');


class Empleado
{
    private $_dbh = null;

    function __construct()
    {
        $this->_dbh = new DataBase();
        
    }

    public function obtenerEmpleados()
    {
        $result = $this->_dbh->consultar('SELECT * FROM Empleado', []);

        if ($result['ok'])
            echo  json_encode(array(
                "ok" => $result['ok'],
                "result" => $result['result']
            ));
        else
            echo  json_encode(array(
                "ok" => $result['ok'],
                "message" => 'No hay salarios',
            ));
    }
    
    public function insertarEmpleado($nombre, $telefono)
    {
        $result = $this->_dbh->insertar_actuallzar_eliminar('INSERT INTO Empleado VALUES (0, ?, ?)', [$nombre, $telefono]);

        if ($result['ok'])
            echo  json_encode(array(
                "ok" => $result['ok'],
                "message" => 'Empleado guardado'
            ));
        else
            echo  json_encode(array(
                "ok" => $result['ok'],
                "message" => 'Error al guardar el empleado',
                "error" => $result['error']
            ));
    }

    public function actualizarEmpleado($id, $nombre, $telefono)
    {
        $result = $this->_dbh->insertar_actuallzar_eliminar('UPDATE Empleado SET nombre = ?, telefono = ? WHERE id = ?', [$nombre, $telefono, $id]);

        if ($result['ok'])
            echo  json_encode(array(
                "ok" => $result['ok'],
                "message" => 'Empleado actualizado'
            ));
        else
            echo  json_encode(array(
                "ok" => $result['ok'],
                "message" => 'Error al actualizar el empleado',
                "error" => $result['error']
            ));
    }
}
