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

echo "<h1>tests : sélectionner id, nom, descr, tarif where tarif < 1000</h1>";
$res = \hellokant\query\Query::table("article")
    ->select(['id', 'nom', 'descr', 'tarif'])
    ->where('tarif', '<', 1000)
    ->get();
echo json_encode($res);


echo "<h1>tests : insert</h1>";
$id = \hellokant\query\Query::table('article')->insert(["nom"=>"zoe", "tarif"=>200, "id_categ"=>1]);
echo "<br><br>"."article inséré id : ".$id."<br><br>";


echo "<h1>tests : delete</h1>";
\hellokant\query\Query::table("article")->where("id", "=", $id)->delete();
echo "<br><br>"."article supprimé id : ".$id."<br><br>";









