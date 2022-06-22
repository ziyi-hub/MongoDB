<?php

require_once __DIR__ . "/vendor/autoload.php";
use hellokant\connection\ConnectionFactory;


try {
    $conf = parse_ini_file('src/conf/conf.ini') ;
    ConnectionFactory::makeConnection($conf);
} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}

echo "/model-test.php";
echo "<br><br>";
echo "/query-test.php";
echo "<br><br>";

