<?php
require '../../tools/config.tools.php';
require '../../classes/cliente.class.php';

try {
    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];
    $telefono = $_POST['telefono'];

    $tools = new Tools();

    if (isset($nombre)) {
        if (isset($correo)) {
            if (isset($telefono)) {
                $cliente = new Cliente();
                $cliente->setAll([$nombre, $correo, $telefono]);
                return $cliente->agregarCliente();
            } else $tools->setStatus(400, 'Es necesario el teléfono del cliente', false);;
        } else $tools->setStatus(400, 'Es necesario el correo del cliente', false);
    } else $tools->setStatus(400, 'Es necesario el nombre del cliente', false);
} catch (\Throwable $th) {
    $tools->setStatus(500, 'Error en el servidor', false);
}
