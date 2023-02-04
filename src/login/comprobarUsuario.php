<?php
namespace App\login;
use PDO;

$pdo = new PDO('mysql:host=localhost:3306;dbname=cine', 'root', '');

$usuario = "prueba2";
$password = "prueba2";
 
$sql = "SELECT password FROM usuarios WHERE login=:usuario LIMIT 1";
 
$sth = $pdo->prepare($sql);
$sth->bindParam(':usuario', $usuario, PDO::PARAM_STR);
$sth->execute();
 
$result = $sth->fetch(PDO::FETCH_NUM);
 
if(password_verify($password, $result[0])) {
    echo "Login correcto";
} else {
    echo "Credenciales no correctas";
}