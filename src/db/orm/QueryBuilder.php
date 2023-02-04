<?php

namespace App\db\orm;

use App\db\orm\DB;
use App\DAO\impl\MoviesDBDAO;



class QueryBuilder {
 
    private string $fields = '*';
 
    private string $where = "";
 
    private ?array $params = null;
 
    private string $sql;
     
    function __construct(private string $table) {
        $this->table = $table;
    }

    public function select(?string $fields = null) {
        $this->fields = (is_null($fields))? '*': $fields;
        return $this;
    }

    public function where(string $field, string $condition, ?string $value) {
        if (is_null($value)) {
            $value = $condition;
            $condition = '=';
        }
        $this->where = "WHERE $field $condition :$field";
        $this->params[":$field"] = $value;
        return $this;
    }

    public function get():array {
        $this->sql = "SELECT $this->fields FROM $this->table $this->where";
        return DB::select($this->sql, $this->params);
    }
         
    public function getOne():\stdClass {
        $this->sql = "SELECT $this->fields FROM $this->table $this->where LIMIT 1";
        return DB::selectOne($this->sql, $this->params);
    }  

    public function find(int $id) {
        $this->where('id', '=', $id);
        return $this->getOne();
    }

    private function toSql() {
        dd($this->sql);
    }

    public function insert(array $data):int {
        $fieldsParams = "";
        foreach ($data as $key => $value) {
            $fieldsParams .= ":$key,";
            $this->params[":$key"] = $value;
        }
        $fieldsParams = rtrim($fieldsParams, ',');//rtrim elimina caracteres del lado derecho del string
        $fieldsName = implode(",", array_keys($data));//implode transforma los elementos de un array en un string
        $this->sql = "INSERT INTO $this->table($fieldsName) VALUES ($fieldsParams)";
        return DB::insert($this->sql, $this->params);
    }

    public function delete(int $id) {
        $this->where('id', '=', $id);
        $this->sql = "DELETE FROM $this->table $this->where";
        return DB::delete($this->sql, $this->params);
    }

    public function update(int $id, array $data): int {
        $fieldsParams = "";
        foreach ($data as $key => $value) {
            $fieldsParams .= "$key=:$key,";
            $this->params[":$key"] = $value;
        }
        $this->where('id', '=', $id);
        $fieldsParams = rtrim($fieldsParams, ',');
        $this->sql = "UPDATE $this->table SET $fieldsParams $this->where";
        return DB::update($this->sql, $this->params);
    }

    // public function join(string $table1, string $table2 ):array{
    //     $this->where( "t1.$this->primary_key", "=", $this->fields);
    //  $this->sql = "SELECT $this->fields FROM $table1 as $t1 JOIN $table2 as $t2 ON"  
    // }

    public function paginated(int $limite, int $offset){
        $this->sql = "SELECT $this->fields FROM $this->table $this->where LIMIT $limite OFFSET $offset";
        return DB::select($this->sql, $this->params);
    }  



}