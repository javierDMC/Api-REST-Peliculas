<?php

namespace App\controllers;

use App\Recibir;
use Throwable;
use App\services\impl\MoviesService;
use App\services\IMoviesService;
use App\factories\MoviesFactory;
use App\response\HTTPResponse;
use App\DTO\MovieDTO;
use App\validator\impl\Validator;
use App\validator\IValidator;
use App\services\impl\ActoresService;
use App\services\IActoresService;
use App\factories\ActoresFactory;

class MoviesController {
 
    public function all(){
        HTTPResponse::json(200, MoviesFactory::getService()->all());
    }

    public function allPaginated($pag){
        HTTPResponse::json(200, MoviesFactory::getService()->allPaginated($pag));
    }

    public function allActores($id){
        try{
            HTTPResponse::json(200, ActoresFactory::getService()->findActoresByIdPelicula($id));
        }catch(\Exception $e){
            HTTPResponse::json($e->getCode(), $e->getMessage());
         } 
        
    }
 
    public function find($id){
        try{
        HTTPResponse::json(200, MoviesFactory::getService()->find($id));
         }catch(\Exception $e){
            HTTPResponse::json($e->getCode(), $e->getMessage());
         } 
    }

    public function insert() {
        try {
            $data = json_decode(file_get_contents('php://input'), true);
            Validator::validadorCamposCreate($data);
            Recibir::getting();
        } catch (\Exception $e) {
            HTTPResponse::json($e->getCode(), $e->getMessage());
        }
    }

    public function delete($id) {
        try {
            $data = json_decode(file_get_contents('php://input'), true);
            MoviesFactory::getService()::delete($id);
            HTTPResponse::json(204, "Recurso eliminado");
        } catch (\Exception $e) {
            HTTPResponse::json($e->getCode(), $e->getMessage());
        }
    }

    public function update($id) {
        try {
            $data = json_decode(file_get_contents('php://input'), true);
            Validator::validadorCamposUpdate($id,$data);
        } catch (\Exception $e) {
            HTTPResponse::json($e->getCode(), $e->getMessage());
        }
    }
}

?>