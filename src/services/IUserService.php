<?php

namespace App\services;
use App\DTO\UserDTO;

interface IUserService {

    public static function register(UserDTO $user): bool;
}