<?php

namespace td1\modele;
use Illuminate\Database\Eloquent\Model;

Class item extends Model{
    protected $table='item';
    protected $primaryKey='id';

    public function commande()
    {
        return $this->belongsToMany('td1\modele\commande', 'item_commande', 'item_id', 'commande_id');
    }

    public static function question12(){
        $item = new item;
        $items = $item::query()->get();
        foreach ($items as $item){
            echo $item->commande()->get();
        }
    }

    public static function question13(){
        $commandes = item::query()->get();
        foreach ($commandes as $commande){
            $liste = $commande->commande()->get();
            foreach ($liste as $val){
                if ($val->nom_client === "Aaron McGlynn"){
                    echo $val;
                }
            }
        }
    }


    public static function question21(){
        $commandes = commande::query()->get();
        foreach ($commandes as $carte){
            $arrays = $carte->carte()
                ->with('commande')
                ->get();

            foreach ($arrays as $array){
                $item = $array->commande()->count();
                if ($item > 3){
                    echo $carte;
                }
            }
        }
    }

}