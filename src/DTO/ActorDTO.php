<?php 

namespace App\DTO;

use JsonSerializable;
 
class ActorDTO implements JsonSerializable{
 
    /**
     * @param $id int 
     * @param $nombreActor string 
   
     */
    function __construct(private ?int $id, private ?string $nombreActor) 
    {
        $this->id = $id;
        $this->nombreActor = $nombreActor;

    }
 
 
    /**
     * @return int
     */
    public function id(): int {
        return $this->id;
    }
 
    /**
     * @return string
     */
    public function nombreActor(): string {
        return $this->nombreActor;
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
            'nombreActor' => $this->nombreActor
        ];      
    }
}