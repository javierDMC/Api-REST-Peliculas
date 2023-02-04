<?php

namespace App\services\impl;
 
use App\services\IActoresService;
use App\DTO\ActorDTO;
use App\DAO\IActoresDAO;
use App\factories\ActoresFactory;

class ActoresService implements IActoresService {

    public function findActoresByIdPelicula($id): array{
        return ActoresFactory::getDAO()->findActoresByIdPelicula($id);
    }         
    
}