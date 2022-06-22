<?php

require_once __DIR__ . "/vendor/autoload.php";

use hellokant\connection\ConnectionFactory;
use hellokant\model\Article;
use hellokant\model\Categorie;

try {
    $conf = parse_ini_file('src/conf/conf.ini') ;
    ConnectionFactory::makeConnection($conf);
} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}

/**
 * tests : insert
 */
echo "<h1>tests : insert</h1>";
$a = new Article();
$a->__set("nom", 'A12609');
$a->__set("descr", 'beau velo de course rouge');
$a->__set("tarif", 59.95);
$a->__set("id_categ", 1);
$a->insert();
echo "Article inséré id : " . $a->__get("id") . "<br>";


/**
 * tests : finder
 */
echo "<h1>tests : les Finder</h1>";
echo "<h3>1.1. retourne l'ensemble des lignes de la table sous la forme d'un tableau de Article ==> Article::find()</h3>";
Article::find();

echo "<h3>1.2. retourne l'ensemble des lignes de la table sous la forme d'un tableau de Categorie ==> Categorie::find()</h3>";
Categorie::find();

echo "<h3>2. construire la méthode find() qui permet de sélectionner des lignes dans la base et retourne un tableau d'objets modèles</h3>";
echo "<h3>2.a. retrouve l'article d'id 65 ==> Article::find(65)</h3>";
$articles = Article::find(65);
var_dump($articles);
echo "<br><br>";

echo "<h3>2.b. accepte un paramètre optionnel permettant de choisir les colonnes du résultat ==> Article::find(['nom', 'tarif'], 64)</h3>";
$articles2 = Article::find(["nom", "tarif"], 64);
var_dump($articles2);
echo "<br><br>";

echo "<h3>2.c. accepte un critère de recherche en paramètre, à la place d'un identifiant de d'objet ==> Article::find(['nom', 'tarif'], ['tarif', '<=', 100])</h3>";
$articles4 = Article::find(["nom", "tarif"], ['tarif', '<=', 100]);
var_dump($articles4);
echo "<br><br>";

echo "<h3>2.d. accepte plusieurs critères de recherche en paramètre ==> Article::find([['nom','like','%velo%'], ['tarif','<=',100]])</h3>";
//$articles5 = Article::find([['nom','like','%velo%'], ['tarif','<=',100]]);
//var_dump($articles5);
echo "<br><br>";

echo "<h3>2.e. retourne uniquement le 1er élément du tableau d'objets produit par find() ==> Article::one(65)</h3>";
$articles6 = Article::one(65);
var_dump($articles6);
echo "<br><br>";

echo "<h3>2.e. retourne uniquement le 1er élément du tableau d'objets produit par find() ==> Article::first(65)</h3>";
$articles6 = Article::first(65);
var_dump($articles6);
echo "<br><br>";

echo "<h3>2.e. retourne le 1er élément du tableau d'objets produit par find() ==> Article::first(['tarif', '<=', 100 ])</h3>";
$article7 = Article::first(['tarif', '<=', 100 ]);
var_dump($article7);
echo "<br><br>";

/**
 * tests : delete
 */
echo "<h1>tests : delete</h1>";
echo "<h3>supprime l'article d'id 66</h3>";
try {
    $delete = Article::one(66);
    $delete->delete();
    echo "Suppression de l'article d'id 66";
}catch (\Illuminate\Database\Eloquent\ModelNotFoundException $exception){
    $exception->getMessage();
}



/**
 * tests : all
 */
echo "<h1>tests : all</h1>";
echo "<h3>1. programmer la méthode all() qui retourne l'ensemble des lignes d'Article</h3>";
echo Article::all();

echo "<h3>2. programmer la méthode all() qui retourne l'ensemble des lignes de Categorie</h3>";
echo Categorie::all();

/**
 * tests : Gestion des associations
 */
echo "<h1>tests : Gestion des associations</h1>";
echo "<h3>1. retourne un objet instance du modèle correspondant à la table liée</h3>";
$a = Article::first(64);
$categorie = $a->categorie();
var_dump($categorie);

echo "<h3>2. retourne un tableau d'objets instances du modèle correspondant à la table liée</h3>";
$c = Categorie::first(1);
$list_article = $c->articles();
var_dump($list_article);
echo "<br><br>";

echo "<h3>3. Utiliser ces 2 méthodes pour créer</h3>";
echo "<h3>3.1. la méthode categorie() de la classe Article, qui retourne la categorie d'un article</h3>";
$categorie2 = Article::first(64)->categorie();
var_dump($categorie2);
echo "<br><br>";

echo "<h3>3.2. la méthode articles() de la classe Categorie, qui retourne tous les articles d'une catégorie</h3>";
$list = Categorie::first(1)->articles();
var_dump($list);
echo "<br><br>";

echo "<h3>4. On aimerait maintenant transformer la méthode magique __get() pour que ce qui suit devienne possible</h3>";
$c = Categorie::first(1) ;
$list_articles2 = $c->articles ;
var_dump($list_articles2);
echo "<br><br>";

$a = Article::first(65) ;
$categorie3 = $a->categorie ;
var_dump($categorie3);
echo "<br><br>";

