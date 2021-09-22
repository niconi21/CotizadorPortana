<?php

declare(strict_types=1);

include '../../database/conexion.database.php';
include '../tools/config.tools.php';

class Material
{
    private $tools;
    private $nombre;
    private $precio;
    private $disponible;
    private $largo;
    private $ancho;
    private $grosor;
    private $color;
    private $tipoMaterial;

    public function __construct()
    {
        $this->tools = new Tools();
        $this->setDisponible(true);
    }

    public function setAll(array $data)
    {
        $this->setNombre($data[0]);
        $this->setPrecio($data[1]);
        $this->setLargo($data[2]);
        $this->setAncho($data[3]);
        $this->setGrosor($data[4]);
        $this->setColor($data[5]);
        $this->setTipoMaterial($data[6]);
    }

    public function setTipoMaterial(int $tipoMaterial): void
    {
        $this->tipoMaterial = $tipoMaterial;
    }

    public function getTipoMaterial(): int
    {
        return $this->tipoMaterial;
    }


    public function setColor(string $color): void
    {
        $this->color = $color;
    }

    public function getColor(): string
    {
        return $this->color;
    }

    public function setGrosor(float $grosor): void
    {
        $this->grosor = $grosor;
    }

    public function getGrosor(): float
    {
        return $this->grosor;
    }


    public function setAncho(float $ancho): void
    {
        $this->ancho = $ancho;
    }

    public function getAncho(): float
    {
        return $this->ancho;
    }


    public function setLargo(float $largo): void
    {
        $this->largo = $largo;
    }

    public function getLargo(): float
    {
        return $this->largo;
    }


    public function setDisponible(bool $disponible): void
    {
        $this->disponible = $disponible;
    }

    public function getDisponible()
    {
        return $this->disponible ? 1 : 0;
    }


    public function setPrecio(float $precio): void
    {
        $this->precio = $precio;
    }

    public function getPrecio(): float
    {
        return $this->precio;
    }
    public function setNombre(string $nombre): void
    {
        $this->nombre = $nombre;
    }

    public function getNombre(): string
    {
        return $this->nombre;
    }

    public function agregarMaterial()
    {
        try {
            $db = new DataBase();
            $result = $db->insertar_actuallzar_eliminar(
                'INSERT INTO Material VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)',
                [
                    '0',
                    $this->getNombre(),
                    $this->getPrecio(),
                    $this->getDisponible(),
                    $this->getLargo(),
                    $this->getAncho(),
                    $this->getGrosor(),
                    $this->getColor(),
                    $this->getTipoMaterial()
                ]
            );

            if ($result['ok']) {
                return $this->tools->setStatus(
                    201,
                    "Material registrado",
                    true,
                    array(
                        'Material' => array(
                            'nombre' => $this->getNombre(),
                            'precio' => $this->getPrecio(),
                            'disponible' => $this->getDisponible(),
                            'largo' => $this->getLargo(),
                            'ancho' => $this->getAncho(),
                            'grosor' => $this->getGrosor(),
                            'color' => $this->getColor(),
                            'tipoMaterial' => $this->getTipoMaterial()
                        )
                    )
                );
            } else {
                return $this->tools->setStatus(
                    400,
                    "Material no registrado",
                    false,
                    array('error' => $result['error']->errorInfo[2])
                );
            }
        } catch (\Throwable $th) {
            return $this->tools->setStatus(500, 'Error en el servidor', false);
        }
    }

    public function obtenerMateriales()
    {
        try {
            $db = new DataBase();
            $results = $db->consultar('SELECT * FROM Material', []);
            if ($results['ok']) {
                return $this->tools->setStatus(
                    200,
                    "Información de los materiales registrados",
                    true,
                    array("Materiales" => $results)
                );
            } else {
                return $this->tools->setStatus(
                    404,
                    "Materiales no encontrado",
                    false,
                    array('error' => $results['error']->errorInfo[2])
                );
            }
        } catch (\Throwable $th) {
            $this->tools->setStatus(500, 'Error en el servidor', false);
        }
    }

    public function obtenerMateiral(int $id)
    {
        try {
            $db = new DataBase();
            $result = $db->consultar('SELECT * FROM Material WHERE id = ?', [$id]);
            if ($result['ok'] && sizeof($result['result']) > 0) {
                return $this->tools->setStatus(
                    200,
                    "Informacion del material registrado",
                    true,
                    $result['result']
                );
            } else {
                return $this->tools->setStatus(
                    404,
                    "Material no encontrado",
                    false
                );
            }
        } catch (\Throwable $th) {
            $this->tools->setStatus(500, 'Error en el servidor', false);
        }
    }

    public function actualizarMaterial(int $id)
    {
        try {
            $db = new DataBase();
            $result = $db->consultar('SELECT * FROM Material WHERE id = ?', [$id]);
            if ($result['ok'] && sizeof($result['result']) > 0) {
                $update = $db->insertar_actuallzar_eliminar(
                    'UPDATE Material SET 
                    nombre = ?,
                    precio = ?,
                    disponible = ?,
                    largo = ?,
                    ancho = ?,
                    grosor = ?,
                    color = ?,
                    tipoMaterial = ?
                    WHERE id = ?',
                    [
                        $this->getNombre(),
                        $this->getPrecio(),
                        $this->getDisponible(),
                        $this->getLargo(),
                        $this->getAncho(),
                        $this->getGrosor(),
                        $this->getColor(),
                        $this->getTipoMaterial(), $id
                    ]
                );
                if ($update['ok']) {
                    return $this->tools->setStatus(
                        200,
                        "Material actualizado",
                        true
                    );
                } else return $this->tools->setStatus(
                    400,
                    "Material no actualizado",
                    false,
                    array('error' => $update['error']->errorInfo[2])
                );
            } else return $this->tools->setStatus(
                404,
                "Material no encontrado",
                false
            );
        } catch (\Throwable $th) {
            $this->tools->setStatus(500, 'Error en el servidor', false);
        }
    }
}
