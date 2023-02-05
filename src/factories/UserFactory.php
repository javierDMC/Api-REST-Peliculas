<?php
namespace App\factories;
use App\DAO\impl\UserDBDAO;
use App\DAO\IUserDAO;
use App\services\IUserService;
use App\services\impl\UserService;

class UserFactory{

    public static function getService(): IUserService{

        return new UserService();
    }

    public static function getDAO(): IUserDAO{
        return new UserDBDAO();
    }
}