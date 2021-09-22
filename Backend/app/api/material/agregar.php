<?php
require '../../tools/config.tools.php';
require '../../classes/material.class.php';

try {
    $nombre = $_POST['nombre'];
    $precio = $_POST['precio'];
    $largo = $_POST['largo'];
    $ancho = $_POST['ancho'];
    $grosor = $_POST['grosor'];
    $color = $_POST['color'];
    $tipoMaterial = $_POST['tipoMaterial'];

    $tools = new Tools();

    if (isset($nombre))
        if (isset($precio)) {
            $precio = floatval($precio);
            if (is_float($precio)) {
                if (isset($largo)) {
                    $largo = floatval($largo);
                    if (is_float($largo)) {
                        if (isset($ancho)) {
                            $ancho = floatval($ancho);
                            if (is_float($ancho)) {
                                if (isset($grosor)) {
                                    $grosor = floatval($grosor);
                                    if (is_float($grosor)) {
                                        if (isset($color))
                                            if (isset($tipoMaterial)) {
                                                $tipoMaterial = intval($tipoMaterial);
                                                if (is_numeric($tipoMaterial)) {
                                                    $material = new Material();
                                                    $material->setAll([
                                                        $nombre,
                                                        $precio,
                                                        $largo,
                                                        $ancho,
                                                        $grosor,
                                                        $color,
                                                        $tipoMaterial
                                                    ]);
                                                    return $material->agregarMaterial();
                                                } else $tools->setStatus(400, 'El tipo de material debe de ser numérico', false);
                                            } else $tools->setStatus(400, 'Es necesario el tipo del material', false);
                                        else $tools->setStatus(400, 'Es necesario el color del material', false);
                                    } else {
                                        $tools->setStatus(400, 'El grosor debe de ser numérico', false);
                                    };
                                } else $tools->setStatus(400, 'Es necesario el grosor del material', false);
                            } else $tools->setStatus(400, 'El ancho debe de ser numérico', false);
                        } else $tools->setStatus(400, 'Es necesario el ancho del material', false);
                    } else $tools->setStatus(400, 'El largo debe de ser numérico', false);
                } else $tools->setStatus(400, 'Es necesario el largo del material', false);
            } else $tools->setStatus(400, 'El precio debe de ser numérico', false);
        } else $tools->setStatus(400, 'Es necesario el precio del material', false);
    else $tools->setStatus(400, 'Es necesario el nombre del material', false);
} catch (\Throwable $th) {
    echo $th;
    $tools->setStatus(500, 'Error en el servidor', false);
}
