<?php

namespace hellokant\model;
use hellokant\connection\ConnectionFactory;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class Article extends Model
{
    public $id, $nom, $descr, $tarif, $stock, $id_categ;
    protected static $table="article";
    protected static $idColumn="id";

    public function categorie(){
        return $this->belongs_to("hellokant\model\Categorie", "id_categ");
    }

    /**
     * Il permet de getter toutes les données d'article
     */
    public static function all(){
        $pdo = ConnectionFactory::getConnection();
        $reponse = $pdo->query('select * from article');
        while ($donnees = $reponse->fetch())
        {
            ?>
            <p>
                <strong>ID d'article est</strong> : <?php echo $donnees['id']; ?><br />
                nom d'article est : <?php echo $donnees['nom']; ?>,<br />
                description est <?php echo $donnees['descr']; ?>, <br />
                tarif est : <?php echo $donnees['tarif']; ?> euros<br />
                stock est : <?php echo $donnees['stock']; ?><br />
                <em>id catégorie est : <?php echo $donnees['id_categ']; ?></em>
            </p>
            <?php
        }
        $reponse->closeCursor();
    }

    public function estDispo(){
        return ($this->stock > 0);
    }

    public function getCategorie(){
        return $this->id_categ;
    }

    public function setCategorie($categorie)
    {
        $this->categorie = $categorie;
        $this->insert();
    }

    public function calculerPrixTTC(){
        return $this->tarif;
    }


}