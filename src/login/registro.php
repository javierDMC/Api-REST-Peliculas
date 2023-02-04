<?php
namespace App\login;
use PDO;

$pdo = new PDO('mysql:host=localhost:3306;dbname=cine', 'root', '');

$usuario = "prueba1";
$password = "prueba1";
 
$sql = "INSERT INTO usuarios(login, password) VALUES(:usuario, :password)";
 
$sth = $pdo->prepare($sql);
$sth->bindParam(':usuario', $usuario, PDO::PARAM_STR);
$sth->bindParam(':password', $password, PDO::PARAM_STR);
if($sth->execute()) {
    echo "Usuario registrado";
} else {
    echo "Fallo en el registro del usuario";
}
