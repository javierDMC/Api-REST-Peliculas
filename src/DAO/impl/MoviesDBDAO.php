<?php

namespace App\DAO\impl;

use App\DAO\IMoviesDAO;
use App\DTO\MovieDTO;
use App\factories\DBFactory;
use App\db\orm\DB;
use App\db\orm\Validator;

class MoviesDBDAO implements IMoviesDAO{

    static function create(MovieDTO $movie): bool {
        return DB::table('peliculas')->insert(['titulo' => $movie->titulo(), 'anyo' => $movie->anyo(), 'duracion' => $movie->duracion()]);
    }
     
    static function read(): array {
        $result = array();
        $db_data = DB::table('peliculas')->select('*')->get();
        foreach ($db_data as $movie) {
            $result[] = new MovieDTO(
                $movie->id, 
                $movie->titulo, 
                $movie->anyo, 
                $movie->duracion
            );            
        }
    return $result;
    }

    static function readPaginated(int $pag): array {
        $limite = 3;
        $offset = ($pag - 1) * $limite;
        $result = array();
        $db_data = DB::table('peliculas')->paginated($limite,$offset);
        foreach ($db_data as $movie) {
            $result[] = new MovieDTO(
                $movie->id, 
                $movie->titulo, 
                $movie->anyo, 
                $movie->duracion
            );            
        }
    return $result;
    }
     
    static function findById(int $id): MovieDTO {
        $db_data = DB::table('peliculas')->find($id);
        $result = new MovieDTO(
                $db_data->id, 
                $db_data->titulo, 
                $db_data->anyo, 
                $db_data->duracion
            );            
    return $result; 
    }
 
    static function update(int $id, MovieDTO $movie): bool {   
        return DB::table('peliculas')->update($id, ['titulo' => $movie->titulo(), 'anyo' => $movie->anyo(), 'duracion' => $movie->duracion()]);
    }
     
    static function delete(int $id): bool {
        $db_data = DB::table('peliculas')->delete($id);
       return $db_data;
    }


}

?>