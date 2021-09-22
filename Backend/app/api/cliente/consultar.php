<?php
require '../../tools/config.tools.php';
require '../../classes/cliente.class.php';

try {
    $id = null;
    $tools = new Tools();
    $cliente = new Cliente();
    if (isset($_GET['id']))
        if (is_numeric($_GET['id'])) {
            $id =  intval($_GET['id']);
            return $cliente->obtenerCliente($id);
        } else
            return $tools->setStatus(400, "El id debe de ser un número", false);
    else return $cliente->obtenerClientes();
} catch (\Throwable $th) {
    $tools->setStatus(500, 'Error en el servidor', false);
}
