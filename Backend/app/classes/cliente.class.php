<?php

declare(strict_types=1);

include '../../database/conexion.database.php';
include '../tools/config.tools.php';

class Cliente
{
    private $tools;
    private $nombre;
    private $telefono;
    private $correo;

    public function __construct()
    {
        $this->tools = new Tools();
    }

    public function setAll(array $data)
    {
        $this->setNombre($data[0]);
        $this->setCorreo($data[1]);
        $this->setTelefono($data[2]);
    }

    public function setCorreo(string $correo): void
    {
        $this->correo = $correo;
    }

    public function getCorreo(): string
    {
        return $this->correo;
    }

    public function setTelefono(string $telefono): void
    {
        $this->telefono = $telefono;
    }

    public function getTelefono(): string
    {
        return $this->telefono;
    }

    public function setNombre(string $nombre): void
    {
        $this->nombre = $nombre;
    }

    public function getNombre(): string
    {
        return $this->nombre;
    }

    public function agregarCliente()
    {
        try {
            $db = new DataBase();
            $result = $db->insertar_actuallzar_eliminar(
                'INSERT INTO Cliente VALUES (?, ?, ?, ?)',
                ['0', $this->getNombre(), $this->getCorreo(), $this->getTelefono(),]
            );

            if ($result['ok']) {
                return $this->tools->setStatus(
                    201,
                    "Cliente registrado",
                    true,
                    array(
                        'cliente' => array(
                            'nombre' => $this->getNombre(),
                            'correo' => $this->getCorreo(),
                            'telefono' => $this->getTelefono(),
                        )
                    )
                );
            } else {
                return $this->tools->setStatus(
                    400,
                    "Cliente no registrado",
                    false,
                    array('error' => $result['error']->errorInfo[2])
                );
            }
        } catch (\Throwable $th) {
            return $this->tools->setStatus(500, 'Error en el servidor', false);
        }
    }

    public function obtenerClientes()
    {
        try {
            $db = new DataBase();
            $results = $db->consultar('SELECT * FROM Cliente', []);
            if ($results['ok']) {
                return $this->tools->setStatus(
                    200,
                    "Información de clientes registrados",
                    true,
                    array("clientes" => $results)
                );
            } else {
                return $this->tools->setStatus(
                    404,
                    "Clientes no encontrados",
                    false,
                    array('error' => $results['error']->errorInfo[2])
                );
            }
        } catch (\Throwable $th) {
            $this->tools->setStatus(500, 'Error en el servidor', false);
        }
    }

    public function obtenerCliente(int $id)
    {
        try {
            $db = new DataBase();
            $result = $db->consultar('SELECT * FROM Cliente WHERE id = ?', [$id]);
            if ($result['ok'] && sizeof($result['result']) > 0) {
                return $this->tools->setStatus(
                    200,
                    "Informacion del cliente registrado",
                    true,
                    $result['result']
                );
            } else {
                return $this->tools->setStatus(
                    404,
                    "Cliente no encontrado",
                    false
                );
            }
        } catch (\Throwable $th) {
            $this->tools->setStatus(500, 'Error en el servidor', false);
        }
    }

    public function actualizarCliente(int $id)
    {
        try {
            $db = new DataBase();
            $result = $db->consultar('SELECT * FROM Cliente WHERE id = ?', [$id]);
            if ($result['ok'] && sizeof($result['result']) > 0) {
                $update = $db->insertar_actuallzar_eliminar('UPDATE Cliente SET nombre = ?, correo = ?, telefono = ? WHERE id = ?', [$this->getNombre(), $this->getCorreo(), $this->getTelefono(), $id]);
                if ($update['ok']) {
                    return $this->tools->setStatus(
                        200,
                        "Cliente actualizado",
                        true
                    );
                } else return $this->tools->setStatus(
                    400,
                    "Cliente no actualizado",
                    false,
                    array('error' => $update['error']->errorInfo[2])
                );
            } else return $this->tools->setStatus(
                404,
                "Cliente no encontrado",
                false
            );
        } catch (\Throwable $th) {
            $this->tools->setStatus(500, 'Error en el servidor', false);
        }
    }
}
