<?php

namespace App\factories;

use App\DAO\impl\ActoresDBDAO;
use App\services\impl\ActoresService;
use App\DAO\IActoresDAO;
use App\services\IActoresService;

class ActoresFactory {

    public static function getService(): IActoresService{
        return new ActoresService();
    }


    public static function getDAO(): IActoresDAO{
        return new ActoresDBDAO();
    }


}