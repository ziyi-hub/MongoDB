<?php

namespace  hellokant\connection;
use PDOException;
use PDO;

class ConnectionFactory
{
    private static $config = null;
    private static $db = null;

    public static function makeConnection(array $conf)
    {
        self::$config =  $conf;
        if (is_null(self::$config))throw new PDOException("conf file could not be parsed");
    }

    public static function getConnection(){
        if (is_null(self::$db)){
            $dbtype = self::$config['driver'];
            $host = self::$config['host'];
            $dbname = self::$config['database'];
            $user = self::$config['username'];
            $pass = self::$config['password'];
            $port = (isset(self::$config['con_db_port']))? self::$config['con_db_port']:null;
            $dns = "$dbtype:host=$host;";
            if (!empty($port))$dns .= "port=$port;";
            $dns .= "dbname=$dbname";

            try {
                self::$db = new PDO($dns, $user, $pass, array(
                                                            PDO::ATTR_PERSISTENT => true ,
                                                            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION ,
                                                            PDO::ATTR_EMULATE_PREPARES => false ,
                                                            PDO::ATTR_STRINGIFY_FETCHES => false));

                self::$db->prepare('set names\'UTF8\'')->execute();
            }catch (PDOException $e){
                $e->getMessage();
                throw new DBException("connection : " . $e->getMessage());
            }
        }
        return self::$db;
    }
}