<?php

namespace App\DAO;
 
interface IActoresDAO {
 
    public static function findActoresByIdPelicula(int $id): array;

}
