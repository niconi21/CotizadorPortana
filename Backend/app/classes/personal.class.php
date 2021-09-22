<?php

declare(strict_types=1);

include '../../database/conexion.database.php';
include '../tools/config.tools.php';
class Personal
{
    private $tools;
    private $nombre;

    public function __construct()
    {
        $this->tools = new Tools();
    }

    public function setAll(array $data)
    {
        $this->setNombre($data[0]);
    }


    public function setNombre(string $nombre): void
    {
        $this->nombre = $nombre;
    }

    public function getNombre(): string
    {
        return $this->nombre;
    }

    public function agregarPersonal()
    {
        try {
            $db = new DataBase();
            $result = $db->insertar_actuallzar_eliminar(
                'INSERT INTO Personal VALUES (?, ?, NOW())',
                ['0', $this->getNombre()]
            );

            if ($result['ok']) {
                return $this->tools->setStatus(
                    201,
                    "Personal registrado",
                    true,
                    array(
                        'Personal' => array(
                            'nombre' => $this->getNombre(),
                        )
                    )
                );
            } else {
                return $this->tools->setStatus(
                    400,
                    "Personal no registrado",
                    false,
                    array('error' => $result['error']->errorInfo[2])
                );
            }
        } catch (\Throwable $th) {
            return $this->tools->setStatus(500, 'Error en el servidor', false);
        }
    }

    public function obtenerTodoPersonal()
    {
        try {
            $db = new DataBase();
            $results = $db->consultar('SELECT * FROM Personal', []);
            if ($results['ok']) {
                return $this->tools->setStatus(
                    200,
                    "Información del personal registrados",
                    true,
                    array("Personal" => $results)
                );
            } else {
                return $this->tools->setStatus(
                    404,
                    "Persona no encontrado",
                    false,
                    array('error' => $results['error']->errorInfo[2])
                );
            }
        } catch (\Throwable $th) {
            $this->tools->setStatus(500, 'Error en el servidor', false);
        }
    }

    public function obtenerPersonal(int $id)
    {
        try {
            $db = new DataBase();
            $result = $db->consultar('SELECT * FROM Personal WHERE id = ?', [$id]);
            if ($result['ok'] && sizeof($result['result']) > 0) {
                return $this->tools->setStatus(
                    200,
                    "Informacion del personal registrado",
                    true,
                    $result['result']
                );
            } else {
                return $this->tools->setStatus(
                    404,
                    "Personal no encontrado",
                    false
                );
            }
        } catch (\Throwable $th) {
            $this->tools->setStatus(500, 'Error en el servidor', false);
        }
    }

    public function actualizarPersonal(int $id)
    {
        try {
            $db = new DataBase();
            $result = $db->consultar('SELECT * FROM Personal WHERE id = ?', [$id]);
            if ($result['ok'] && sizeof($result['result']) > 0) {
                $update = $db->insertar_actuallzar_eliminar('UPDATE Personal SET nombre = ? WHERE id = ?', [$this->getNombre(), $id]);
                if ($update['ok']) {
                    return $this->tools->setStatus(
                        200,
                        "Personal actualizado",
                        true
                    );
                } else return $this->tools->setStatus(
                    400,
                    "Personal no actualizado",
                    false,
                    array('error' => $update['error']->errorInfo[2])
                );
            } else return $this->tools->setStatus(
                404,
                "Personal no encontrado",
                false
            );
        } catch (\Throwable $th) {
            $this->tools->setStatus(500, 'Error en el servidor', false);
        }
    }
}
