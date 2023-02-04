<?php

namespace App;

include "conexion.php";

class Recibir{

    public static function getting(){

        $json = file_get_contents('php://input');

        $data = json_decode($json);

        /*$sql = "INSERT INTO peliculas (titulo, anyo, duracion) VALUES ('$data->titulo', '$data->anyo', $data->duracion)";

        $count = $pdo->exec($sql);

        echo json_encode(["Resultado" => "Insertados $count peliculas"]);*/

        echo json_encode($data);
    }

    

}


