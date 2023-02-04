<?php

namespace App\db\orm;


use App\factories\DBFactory;


class DB {


    public static function select(string $sql, ?array $params = null):array {
        $result = array();
        $data = self::execute($sql, $params);
        foreach ($data as $record) {
            $result[] = ((object) $record);
        }
        return $result;
    }

    public static function selectOne(string $sql, ?array $params = null): \stdClass {
        $data = self::execute($sql, $params);
        if(count($data) > 0) {
            return (object) $data[0];
        }
        throw new \Exception("Not found", 404);        
    }

    public static function insert(string $sql, array $params): int {
        return self::executeNoResult($sql, $params);
    }

    private static function execute(string $sql, ?array $params = null):array {
        $pdo = DBFactory::getConnection()::connect();
        $ps = $pdo->prepare($sql);
        $ps->execute($params);
        return $ps->fetchAll(\PDO::FETCH_ASSOC); 
    }
         
    private static function executeNoResult(string $sql, array $params):int {
        $pdo = DBFactory::getConnection()::connect();
        try {
            $ps = $pdo->prepare($sql);
            return $ps->execute($params); 
        } catch (\Throwable $th){
            throw new \Exception("Bad request", 400);
        }
    }
    
    public static function table(string $table):QueryBuilder {
        return new QueryBuilder($table);
    }

    public static function delete(string $sql, array $params){
        return self::executeNoResult($sql, $params);
    }

    public static function update(string $sql, ?array $params){
        return self::executeNoResult($sql, $params);
    }

    
}