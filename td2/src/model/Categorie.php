<?php


namespace hellokant\model;
use hellokant\connection\ConnectionFactory;
use Illuminate\Database\Eloquent\ModelNotFoundException;


class Categorie extends Model
{
    //private $id, $nom, $description;
    protected static $table="categorie";
    protected static $idColumn="id";

    public function articles(){
        return $this->has_many('\hellokant\model\Article', 'id_categ');
    }

    /**
     * Il permet de getter toutes les données de catégorie
     */
    public static function all(){
        $pdo = ConnectionFactory::getConnection();
        $reponse = $pdo->query('select * from categorie');
        while ($donnees = $reponse->fetch())
        {
            ?>
            <p>
                <strong>ID de catégorie est</strong> : <?php echo $donnees['id']; ?><br />
                nom de catégorie est : <?php echo $donnees['nom']; ?>,<br />
                description est <?php echo $donnees['descr']; ?>, <br />
            </p>
            <?php
        }
        $reponse->closeCursor();
    }

}