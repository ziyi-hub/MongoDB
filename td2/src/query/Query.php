<?php

namespace hellokant\query;
use hellokant\connection\ConnectionFactory;
use PDO;

class Query
{
    private $sqltable;
    private $fields = "*";
    private $where = null;
    private $args = [];
    private $sql = '';

    private function __construct($table){
        $this->sqltable = $table;
    }

    public static function table($table){
        return new Query($table);
    }

    public function where($col, $op, $val){
        if (!is_null($this->where)){
            $this->where .= " and ";
        }
        $this->where .= ' '.$col.' '.$op.' ? ';
        $this->args[] = $val;
        return $this;
    }

    public function get(){
        $pdo = ConnectionFactory::getConnection();
        $this->sql = ' select '.$this->fields.' from '.$this->sqltable;
        if (!is_null($this->where)){
            $this->sql .= " where ".$this->where;
        }
        $stmt = $pdo->prepare($this->sql);
        $stmt->execute($this->args);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function one(){
        $this->sql = ' select '.$this->fields.' from '.$this->sqltable;
        if (!is_null($this->where)){
            $this->sql .= " where ".$this->where;
        }
        $this->sql .= ' LIMIT 1 ';
        $pdo = ConnectionFactory::getConnection();
        $stmt = $pdo->prepare($this->sql);
        $stmt->execute($this->args);
        $fetchall = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $fetchall[0];
    }

    public function select($fields){
        $this->fields = implode(',', $fields);
        return $this;
    }

    public function update($value){
        $pdo = ConnectionFactory::getConnection();
        $this->sql = 'update '.$this->sqltable.'set'.$this->fields."=".$value;
        $stmt = $pdo->prepare($this->sql);
        $stmt->execute($this->args);
    }

    public function delete()
    {
        $pdo = ConnectionFactory::getConnection();
        $this->sql = "delete from ".$this->sqltable;
        if (!is_null($this->where)){
            $this->sql .= " where ".$this->where;
        }
        $stmt = $pdo->prepare($this->sql);
        return $stmt->execute($this->args);
    }


    public function insert(array $table){
        $this->sql = "insert into ".$this->sqltable;
        $into = [];
        $values = [];
        foreach ($table as $attname => $attval){
            $into[] = $attname;
            $values[] = ' ? ';
            $this->args[] = $attval;
        }
        $this->sql .= ' (' . implode(',', $into ) . ') '.'values ('.implode(',', $values).')';
        $pdo = ConnectionFactory::getConnection();
        $stmt = $pdo->prepare($this->sql);
        $stmt->execute($this->args);
        return (int)$pdo->lastInsertId($this->sqltable);
    }

    public function getQuery(){
        return [
            "query" => $this->sql,
            "args" => $this->args,
        ];
    }

}