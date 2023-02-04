<?php

namespace App\DAO\impl;

use App\DAO\IActoresDAO;
use App\DTO\ActorDTO;
use App\factories\DBFactory;
use App\db\orm\DB;

class ActoresDBDAO implements IActoresDAO{

    static function findActoresByIdPelicula(int $id): array {
        $result = array();
        $db_data = DB::table('actores')->where('idPelicula', '=', $id)->get();
        foreach ($db_data as $actor) {
            $result[] = new ActorDTO(
                $actor->id, 
                $actor->nombreActor 
            );            
        }    
    return $result; 
    }
}

?>