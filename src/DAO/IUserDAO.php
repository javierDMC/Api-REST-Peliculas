<?php
namespace App\DAO;

use App\DTO\UserDTO;

interface IUserDAO{

    public static function register(UserDTO $user): bool;

    public static function delete(int $id): bool;

    public static function read(): array;

    
}