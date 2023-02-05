<?php

namespace App\validator\impl;

use App\db\orm\DB;
use App\DAO\impl\MoviesDBDAO;
use App\DTO\UserDTO;
use App\factories\UserFactory;
use App\validator\IValidator;
use App\DTO;
use App\services\impl\MoviesService;
use App\services\IMoviesService;
use App\factories\MoviesFactory;
use App\response\HTTPResponse;
use App\DTO\MovieDTO;


class Validator implements IValidator{

    public static function validadorCamposUpdate(int $id, array $movie){
        //utilizo el isset para comprobar que cada uno de las propiedades del objeto no son null
        if(isset($movie['titulo'], $movie['anyo'], $movie['duracion'])){
            $pelicula = self::nuevaMovie($movie);
            MoviesFactory::getService()::update($id, $pelicula);
            HTTPResponse::json(200, "Recurso actualizado");   
        }else{
            throw new \Exception("Bad request", 400);
        }
        
    }

    public static function validadorCamposCreate(array $movie){
        //utilizo el isset para comprobar que cada uno de las propiedades del objeto no son null
        if(isset($movie['titulo'], $movie['anyo'], $movie['duracion'])){
            $pelicula = self::nuevaMovie($movie);
            MoviesFactory::getService()::insert($pelicula);
            HTTPResponse::json(201, "Recurso creado");  
        }else{
            throw new \Exception("Bad request", 400);
        }
    }

    public static function nuevaMovie(array $movie):MovieDTO{
        $movie = new MovieDTO(null, $movie['titulo'], $movie['anyo'], $movie['duracion']);
        return $movie;
    }

    public static function nuevoUsuario(array $user): UserDTO{
        $user = new UserDTO(null, $user['usuario'], $user['password'], $user['admin'], $user['login']);
        return $user;
    }

    public static function loginUsuario(array $user): UserDTO{
        $user = new UserDTO(null, $user['usuario'], $user['password'], null, null);
        return $user;
    }


    public static function validadorCamposUsuarioNuevo(array $user){
        if(isset($user['usuario'], $user['password'], $user['admin'])){
            $usuario = self::nuevoUsuario($user);
            UserFactory::getService()::register($usuario);
            HTTPResponse::json(201, "Usuario registrado con éxito");
        }else{
            throw new \Exception("Bad request", 400);
        }
        
    }

    public static function validadorCamposUsuario(array $user){
        if(isset($user['usuario'], $user['password'])){
            $usuario = self::loginUsuario($user);
            UserFactory::getService()::login($usuario);
        }else{
            throw new \Exception("Acceso denegado", 400);
        }
        
    }

}