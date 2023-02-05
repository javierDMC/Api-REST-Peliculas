<?php
namespace App\DAO\impl;

use App\DAO\IUserDAO;
use App\db\orm\DB;
use App\DTO\UserDTO;

class UserDBDAO implements IUserDAO{

    static function register(UserDTO $user):bool{
        return DB::table('usuarios')->insert(['usuario' => $user->usuario(),
                                              'password' => $user->insertPassword(),
                                              'admin' => $user->admin(),
                                              'login' => false]);
        
    }

    static function delete(int $id):bool {
        $db_data = DB::table('usuarios')->delete($id);
        return $db_data;
    }

    static function read(): array {
        $result = array();
        $db_data = DB::table('usuarios')->select('*')->get();
        foreach ($db_data as $user){
            $result[] = new UserDTO(
                    $user->id,
                    $user->usuario,
                    $user->password,
                    $user->admin,
                    $user->login
            );
        }
        return $result;
    }

    static function login(UserDTO $user):bool{
        $userDB =  DB::table('usuarios')->where('usuario', '=', $user->usuario())->getOne();
        if(password_verify($user->password(),$userDB->password)){
            DB::table('usuarios')->update($userDB->id, ['login'=>true]);
            echo "Login correcto";
            return true;
        }else {
            echo "Credenciales no correctas";
            return false;
        }
    }

    static function logout(int $id):bool{
            DB::table('usuarios')->update($id, ['login'=>false]);
            echo "Logout correcto";
            return true;
        
    }
}