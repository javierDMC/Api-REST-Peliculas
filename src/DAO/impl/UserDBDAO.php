<?php
namespace App\DAO\impl;

use App\DAO\IUserDAO;
use App\db\orm\DB;
use App\DTO\UserDTO;

class UserDBDAO implements IUserDAO{

    static function register(UserDTO $user):bool{
        return DB::table('usuarios')->insert(['usuario' => $user->usuario(),
                                              'password' => $user->password(),
                                              'admin' => $user->admin()]);
        
    }

    static function delete(int $id):bool {
        $db_data = DB::table('usuarios')->delete($id);
        return $db_data;
    }

    
}