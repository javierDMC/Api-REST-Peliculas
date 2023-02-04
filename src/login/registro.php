<?php
namespace App\login;
use PDO;

$pdo = new PDO('mysql:host=localhost:3306;dbname=cine', 'root', '');

$usuario = "prueba2";
$password = "prueba2";
$passwordEncriptado = password_hash($password, PASSWORD_DEFAULT, ['cost' => 10]);
 
$sql = "INSERT INTO usuarios(login, password) VALUES(:usuario, :password)";
 
$sth = $pdo->prepare($sql);
$sth->bindParam(':usuario', $usuario, PDO::PARAM_STR);
$sth->bindParam(':password', $passwordEncriptado, PDO::PARAM_STR);
if($sth->execute()) {
    echo "Usuario registrado";
} else {
    echo "Fallo en el registro del usuario";
}
