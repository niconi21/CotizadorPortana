<?php
require '../../tools/config.tools.php';
require '../../classes/material.class.php';

try {
    $id = null;
    $tools = new Tools();
    $material = new Material();
    if (isset($_GET['id']))
        if (is_numeric($_GET['id'])) {
            $id =  intval($_GET['id']);
            return $material->obtenerMateiral($id);
        } else
            return $tools->setStatus(400, "El id debe de ser un número", false);
    else return $material->obtenerMateriales();
} catch (\Throwable $th) {
    $tools->setStatus(500, 'Error en el servidor', false);
}
