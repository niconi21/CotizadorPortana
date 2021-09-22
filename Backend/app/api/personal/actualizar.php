<?php
require '../../tools/config.tools.php';
require '../../classes/personal.class.php';

try {
    $id = null;
    $nombre = $_POST['nombre'];

    $tools = new Tools();
    $personal = new Personal();

    if (isset($_GET['id']))
        if (is_numeric($_GET['id'])) {
            if (isset($nombre)) {
                        $id =  intval($_GET['id']);
                        $personal->setAll([$nombre]);
                        return $personal->actualizarPersonal($id);
            } else $tools->setStatus(400, 'Es necesario el nombre del cliente', false);
        } else
            return $tools->setStatus(400, "El id debe de ser un número", false);
    else
        return $tools->setStatus(400, "El id es necesario", false);
} catch (\Throwable $th) {
    $tools->setStatus(500, 'Error en el servidor', false);
}
