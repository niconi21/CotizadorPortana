<?php
include '../classes/empleado.class.php';


header('Content-Type: application/json');
$salario = new Empleado();

switch ($_SERVER['REQUEST_METHOD']) {
    case 'GET':
        $salario->obtenerEmpleados();
        break;

    case 'POST':
        $_POST = json_decode(file_get_contents('php://input'), true);
        $result = $salario->insertarEmpleado($_POST['nombre'], $_POST['telefono']);
        break;
    case 'PUT':
        $_PUT = json_decode(file_get_contents('php://input'), true);
        $result = $salario->actualizarEmpleado($_PUT['id'],$_PUT['nombre'], $_PUT['telefono']);
        break;
    // case 'DELETE':
    //     echo 'Método DELETE';
    //     break;

    default:
        # code...
        break;
}
