<?php


namespace td1\modele;
use Illuminate\Database\Eloquent\Model;

class paiement extends Model
{
    protected $table='paiement';
    protected $primaryKey='ref_paiement';

    public function Commande()
    {
        return $this->hasOne("Application\modele\commande");
    }
}