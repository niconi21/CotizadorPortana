<?php
require '../../tools/config.tools.php';
require '../../classes/cliente.class.php';

try {
    $id = null;
    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];
    $telefono = $_POST['telefono'];

    $tools = new Tools();
    $cliente = new Cliente();

    if (isset($_GET['id']))
        if (is_numeric($_GET['id'])) {
            if (isset($nombre)) {
                if (isset($correo)) {
                    if (isset($telefono)) {
                        $id =  intval($_GET['id']);
                        $cliente->setAll([$nombre, $correo, $telefono]);
                        return $cliente->actualizarCliente($id);
                    } else $tools->setStatus(400, 'Es necesario el teléfono del cliente', false);;
                } else $tools->setStatus(400, 'Es necesario el correo del cliente', false);
            } else $tools->setStatus(400, 'Es necesario el nombre del cliente', false);
        } else
            return $tools->setStatus(400, "El id debe de ser un número", false);
    else
        return $tools->setStatus(400, "El id es necesario", false);
} catch (\Throwable $th) {
    $tools->setStatus(500, 'Error en el servidor', false);
}
