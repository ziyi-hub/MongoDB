<?php


namespace td1\modele;
use td1\modele\item;
use Illuminate\Database\Eloquent\Model;

class commande extends Model{
    protected $table='commande';
    protected $primaryKey='id';
    protected $foreignKey='carte_id';

    public function carte()
    {
        return $this->belongsTo('td1\modele\carte');
    }

    public function paiement()
    {
        return $this->hasOne("Application\modele\paiement");
    }


    public function item()
    {
        return $this->belongsToMany('td1\modele\item', 'item_commande', 'commande_id', 'item_id');
    }


    public static function question11(){
        $commande = commande::find("000b2a0b-d055-4499-9c1b-84441a254a36");
        $pivots = $commande->item()->get();
        foreach ($pivots as $pivot){
            if ($pivot->pivot->commande_id === "000b2a0b-d055-4499-9c1b-84441a254a36"){
                echo $pivot;
            }
        }
    }

    public static function question16(){
        $commande = commande::find("9f1c3241-958a-4d35-a8c9-19eef6a4fab3");
        $pivots = $commande->item()->get();
        foreach ($pivots as $pivot){
            if (($pivot->pivot->commande_id === "9f1c3241-958a-4d35-a8c9-19eef6a4fab3") && ($pivot->tarif < 5)){
                echo $pivot;
            }
        }
    }

    public static function question18(){
        $cartes = carte::query()->get();
        foreach ($cartes as $carte){
            $arrays = $carte->commande()
                ->with('carte')
                ->get();
            foreach ($arrays as $array){
                $item = $array->item()->count();
                if ($item > 3){
                    echo $carte;
                }
            }
        }
    }


    public static function question19(){
        $commande = commande::find("9f1c3241-958a-4d35-a8c9-19eef6a4fab3");
        $pivots = $commande->item()->get();
        foreach ($pivots as $pivot){
            if ($pivot->pivot->item_id === 2){
                echo $pivot;
            }
        }
    }


    public static function question22(){
        echo commande::withTrashed()->find(1)->get();
    }


}