<?php

namespace App\DTO;

use JsonSerializable;

class UserDTO implements JsonSerializable
{

   /**
    * @param $id int
    * @param $usuario string
    * @param $password string
    * @param $admin bool
    */

   function __construct(private ?int $id, private string $usuario, private string $password, private ?bool $admin)
   {
      $this->id = $id;
      $this->usuario = $usuario;
      $this->password = $password;
      $this->admin = $admin;

   }

   /**
    * @return int
    */
   public function id(): int
   {
      return $this->id;
   }

   /**
    * @return string
    */
   public function usuario(): string
   {
      return $this->usuario;
   }

   /**
    * @return string
    */
   public function insertPassword(): string
   {
      $password = password_hash($this->password, PASSWORD_DEFAULT, ['cost' => 10]);
      return $password;
   }

   public function password():string{
      return $this->password;
   }

   /**
    * @return int
    */
   public function admin(): bool
   {
      return $this->admin;
   }

   /**
     * Specify data which should be serialized to JSON
     * Serializes the object to a value that can be serialized natively by json_encode().
     *
     * @return mixed Returns data which can be serialized by json_encode(), which is a value of any type other than a resource .
     */
    function jsonSerialize(): mixed {
      return [
          'id' => $this->id,
          'usuario' => $this->usuario,
          'password' => $this->password,
          'admin' => $this->admin
      ];      
  }
}