<?php
require '../../tools/config.tools.php';
require '../../classes/personal.class.php';

try {
    $id = null;
    $tools = new Tools();
    $personal = new Personal();
    if (isset($_GET['id']))
        if (is_numeric($_GET['id'])) {
            $id =  intval($_GET['id']);
            return $personal->obtenerPersonal($id);
        } else
            return $tools->setStatus(400, "El id debe de ser un número", false);
    else return $personal->obtenerTodoPersonal();
} catch (\Throwable $th) {
    $tools->setStatus(500, 'Error en el servidor', false);
}
