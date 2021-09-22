<?php

include('./database/conexion.database.php');
try {
    $db = new DataBase();
    $results = $db->consultar('SELECT * FROM Cliente', []);
    foreach ($results as $result) {
        echo $result->nombre .' | '.$result->telefono .' | '.$result->correo .'<br>';
    }
} catch (Exception $ex) {
    echo $ex;
}
