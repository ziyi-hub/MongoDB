<?php


require_once __DIR__ . '/vendor/autoload.php';
use Illuminate\Database\Capsule\Manager as DB;
use td1\modele\carte;


$db = new DB();
$config= parse_ini_file("src/conf/conf.ini");
$db->addConnection($config);
$db->setAsGlobal();
$db->bootEloquent();

echo "<h1>1. Requêtes simples</h1>";
echo "<h2>liste des cartes de fidélité, avec le nom, mail du propriétaire et le montant cumulé</h2>";
echo \td1\modele\carte::question1();
echo '</br>';
echo '</br>';
/*
echo "<h2>la même liste, trie par ordre alphabétique décroissant du noḿ</h2>";
echo \Application\modele\carte::question2();
echo '</br>';
echo '</br>';

echo "<h2>la carte n°7342 si elle existe, utiliser ModelNotFoundException</h2>";
echo \Application\modele\carte::question3();
echo '</br>';
echo '</br>';

echo "<h2>les cartes dont le nom du propriétaire contient 'Ariane', triées par montant croissant</h2>";
echo \Application\modele\carte::question4();
echo '</br>';
echo '</br>';

echo "<h2>créer une nouvelle carte</h2>";
echo \Application\modele\carte::question5();
echo '</br>';
echo '</br>';

echo "<h1>2. Associations 1-n</h1>";
echo "<h2>afficher la carte n°42 et ses commandes</h2>";
echo \Application\modele\carte::question6();
echo '</br>';
echo '</br>';

echo "<h2>lister les cartes dont le montant est > 1000, et pour chaque carte , lister les commandes associées</h2>";
echo \Application\modele\carte::question7();
echo '</br>';
echo '</br>';

echo "<h2>lister les commandes qui sont associées à une carte,et pour chacune d'elle les informations concernant la carte</h2>";
echo \Application\modele\carte::question8();
echo '</br>';
echo '</br>';

echo "<h2>créer 3 commandes associées à la carte n°10</h2>";
echo \Application\modele\carte::question9();
echo '</br>';
echo '</br>';

echo "<h2>changer la carte associée à la 3ème commande pour l'associer à la carte 11</h2>";
echo \Application\modele\carte::question10();
echo '</br>';
echo '</br>';

echo "<h1>3. Associations N-N et attributs d'associations</h1>";
echo "<h2>lister les items de la commande '000b2a0b-d055-4499-9c1b-84441a254a36'</h2>";
echo \Application\modele\commande::question11();
echo '</br>';
echo '</br>';

echo "<h2>lister tous les items, et pour chaque item, la liste des commandes dans lesquelles il apparaît,</h2>";
echo \Application\modele\item::question12();
echo '</br>';
echo '</br>';

echo "<h2>liste les commandes passées par Aaron McGlynn, avec la liste des itemsassociés ; préciser la quantité de chaque item,</h2>";
echo \Application\modele\item::question13();
echo '</br>';
echo '</br>';

echo "<h1>4. Requêtes sur des associations</h1>";
echo "<h2>Pour la carte dont le mail proprietaire contient 'Aaron.McGlynn', lister les commandes dont l'état est > 0</h2>";
echo \Application\modele\carte::question14();
echo '</br>';
echo '</br>';

echo "<h2>lister les commandes associées à la carte 28, dont l'état est >=0 et le montant > 20.0</h2>";
echo \Application\modele\carte::question15();
echo '</br>';
echo '</br>';

echo "<h2>lister items de la commande '9f1c3241-958a-4d35-a8c9-19eef6a4fab3' dont le tarif est < 5.0,</h2>";
echo \Application\modele\commande::question16();
echo '</br>';
echo '</br>';

echo "<h2>lister les cartes qui ont été utilisées pour plus de 8 commandes</h2>";
echo \Application\modele\carte::question17();
echo '</br>';
echo '</br>';

echo "<h2>lister les cartes qui ont des commandes contenant plus de 3 items</h2>";
echo \Application\modele\commande::question18();
echo '</br>';
echo '</br>';

echo "<h2>lister les commandes contenant l'item n°2,</h2>";
echo \Application\modele\commande::question19();
echo '</br>';
echo '</br>';

echo "<h2>lister les cartes contenant des commandes dont le montant est > 30.0</h2>";
echo \Application\modele\carte::question20();
echo '</br>';
echo '</br>';

echo "<h2>lister les commandes associées à une carte et ayant +3 items.</h2>";
echo \Application\modele\item::question21();
echo '</br>';
echo '</br>';
*/

//withTrashed
echo "<h1>6. Soft Deletes</h1>";
echo "<h2>lister les items de la commande '000b2a0b-d055-4499-9c1b-84441a254a36'</h2>";
echo \td1\modele\commande::question22();
echo '</br>';
echo '</br>';
