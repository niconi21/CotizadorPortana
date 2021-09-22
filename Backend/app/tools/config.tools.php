<?php

declare(strict_types=1);
header('Content-type: application/json');

class Tools
{

    public function setStatus(int $status, string $message, bool $ok, array $result = [])
    {
        try {
            $json = json_encode(array(
                "status" => $status,
                "message" => $message,
                "ok" => $ok,
                "result" => $result
            ));
            http_response_code($status);
        } catch (\Throwable $th) {
            $arr = array(
                'ok' => false,
                'status' => 500,
                'message' => 'Error en el servidor'
            );
            $json = json_encode($arr);
        } finally {
            echo $json;
        }
    }
}
