<?php
include '../classes/salario.class.php';

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: content-type");
header("Access-Control-Allow-Methods: OPTIONS,GET,PUT,POST,DELETE");

header('Content-Type: application/json');
$salario = new Salario();

switch ($_SERVER['REQUEST_METHOD']) {
    case 'GET':
        echo $_GET['limit'] .'<br>';
        $limit =  $_GET['limit'] | 10;
        echo $limit.'<br>';
        $skip  =  $_GET['skip'] | 0;
        $salario->obtenerSalarios($limit, $skip);
        break;

    case 'POST':
        $_POST = json_decode(file_get_contents('php://input'), true);
        $result = $salario->insertarSalario($_POST['nombre'], $_POST['cantidad']);
        break;
    case 'PUT':
        $_PUT = json_decode(file_get_contents('php://input'), true);
        $result = $salario->actualizarSalario($_PUT['id'], $_PUT['nombre'], $_PUT['cantidad']);
        break;
    case 'DELETE':
        echo 'Método DELETE';
        break;

    default:
        # code...
        break;
}
