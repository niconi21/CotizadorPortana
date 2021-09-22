<?php
require '../../tools/config.tools.php';
require '../../classes/personal.class.php';

try {
    $nombre = $_POST['nombre'];

    $tools = new Tools();

    if (isset($nombre)) {
        $personal = new Personal();
        $personal->setAll([$nombre]);
        return $personal->agregarPersonal();
    } else $tools->setStatus(400, 'Es necesario el nombre del personal', false);
} catch (\Throwable $th) {
    $tools->setStatus(500, 'Error en el servidor', false);
}
