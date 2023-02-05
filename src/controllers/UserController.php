<?php
namespace App\controllers;

use App\DTO\UserDTO;
use App\factories\UserFactory;
use App\response\HTTPResponse;
use App\validator\impl\Validator;

class UserController {

    public function register(){
        try{
            $data = json_decode(file_get_contents('php://input'), true);
            Validator::validadorCamposUsuarioNuevo($data);        
        }catch (\Exception $e){
            HTTPResponse::json($e->getCode(), $e->getMessage());
        }

    }

    public function delete($id){
        try{
            UserFactory::getService()::delete($id);
            HTTPResponse::json(204,"Usuario eliminado");
        }catch(\Exception $e){
            HTTPResponse::json($e->getCode(), $e->getMessage());
        }
    }

    public function login(){
        echo ("Usuario login controller");
        // try{
        //     HTTPResponse::json(200, UserFactory::getService()->login($id))
        // }
    }

    public function allUsers(){
        HTTPResponse::json(200, UserFactory::getService()->all());
    }
}