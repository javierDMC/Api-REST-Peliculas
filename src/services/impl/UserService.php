<?php
namespace App\services\impl;
use App\DTO\UserDTO;
use App\factories\UserFactory;
use App\services\IUserService;

class UserService implements IUserService{

    public static function register(UserDTO $user): bool{
        return UserFactory::getDAO()->register($user);
    }

    public static function delete(int $id):bool{
        return UserFactory::getDAO()->delete($id);
    }
}