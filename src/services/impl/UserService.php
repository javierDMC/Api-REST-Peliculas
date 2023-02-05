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

    public static function read(): array{
        return UserFactory::getDAO()->read();
    }

    public static function login(UserDTO $user): bool{
        return UserFactory::getDAO()->login($user);
    }

    public static function logout(int $id):bool{
        return UserFactory::getDAO()->logout($id);
    }

}