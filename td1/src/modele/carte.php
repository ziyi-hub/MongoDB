<?php


namespace td1\modele;
use td1\modele\commande;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class carte extends Model
{
    protected $table='carte';
    protected $primaryKey='id';

    public static function question1(){
        $html = "";
        $cartes = carte::query()
            ->select('nom_proprietaire', 'mail_proprietaire', 'cumul')
            ->get();
        foreach ($cartes as $carte){
            $nom_proprietaire = $carte->nom_proprietaire;
            $mail_proprietaire = $carte->mail_proprietaire;
            $cumul = $carte->cumul;
            $html .=
            "<p>
                <strong>Nom est</strong> : $nom_proprietaire<br />
                mail du propriétaire est $mail_proprietaire<br />
                <em>le montant cumulé est $cumul<br /></em>
            </p>";
        }
         return $html;
    }

    public static function question2(){
        $html = "";
        $cartes = carte::query()
            ->select('nom_proprietaire', 'mail_proprietaire', 'cumul')
            ->orderBy('nom_proprietaire','DESC')
            ->get();
        foreach ($cartes as $carte){
            $nom_proprietaire = $carte->nom_proprietaire;
            $mail_proprietaire = $carte->mail_proprietaire;
            $cumul = $carte->cumul;
            $html .=
                "<p>
                <strong>Nom est</strong> : $nom_proprietaire<br />
                mail du propriétaire est $mail_proprietaire<br />
                <em>le montant cumulé est $cumul<br /></em>
            </p>";
        }
        return $html;
    }

    public static function question3(){
        try {
            $question3 = carte::query()
                ->where('id', "=", 7342)
                ->orderBy('nom_proprietaire','DESC')
                ->get();
        }catch (ModelNotFoundException $exception){
            echo $exception->getMessage();
        }
        return $question3;
    }

    public static function question4(){
        try {
            $html = "";
            $cartes = carte::query()
                ->where('nom_proprietaire', 'like', '%Ariane%')
                ->orderBy('cumul','ASC')
                ->get();
            foreach ($cartes as $carte){
                $id = $carte->id;
                $nom_proprietaire = $carte->nom_proprietaire;
                $mail_proprietaire = $carte->mail_proprietaire;
                $password = $carte->password;
                $created_at = $carte->created_at;
                $updated_at = $carte->updated_at;
                $cumul = $carte->cumul;
                $html .=
                    "<p>
                <strong>ID est</strong> : $id<br />
                <strong>Nom est</strong> : $nom_proprietaire<br />
                mail du propriétaire est $mail_proprietaire<br />
                mot de passe est $password<br />
                <em>created_at $created_at<br /></em>
                <em>updated_at $updated_at<br /></em>
                <em>le montant cumulé est $cumul<br /></em>
            </p>";
            }
        }catch (ModelNotFoundException $exception){
            echo $exception->getMessage();
        }
        return $html;
    }

    public static function question5(){
        $carte = new carte;
        $carte->nom_proprietaire = "Ziyi Wang";
        $carte->password = password_hash("20001027", PASSWORD_DEFAULT);
        $carte->mail_proprietaire = "ziyiwang1027@gmail.com";
        $carte->created_at = "2019-10-10 16:06:02";
        $carte->updated_at = "2019-10-10 16:06:02";
        $carte->cumul = 7000.00;
        //$carte->save();
        return carte::query()->get()->last();
    }

    public function commande()
    {
        return $this->hasMany('td1\modele\commande', "carte_id");
    }

    public static function question6(){
        $carte = carte::find(42);
        return $carte->commande()->with('carte')->get();
    }


    public static function question7(){
        $carte = new carte;
        $cartes = $carte::query()->where("cumul", ">", 1000)->get();
        foreach ($cartes as $carte){
            echo $carte->commande()
                ->with('carte')
                ->get();
        }
    }

    public static function question8(){
        $carte = new carte;
        $cartes = $carte::query()->get();
        foreach ($cartes as $carte){
            echo $carte->commande()
                ->with('carte')
                ->get();
        }
    }

    public static function question9(){
        $commande = new commande;
        $commande->id = "00ziyi10-2700-8866-9v8w-2g5rs7uj9oc4";
        $commande->created_at = "2021-11-12 20:07:00";
        $commande->updated_at = "2021-11-12 20:07:00";
        $commande->date_livraison = "2021-11-15 20:07:00";
        $commande->etat = 1;
        $commande->carte_id = 10;

        $commande2 = new commande;
        $commande2->id = "00paul0-2700-8866-9v8w-2g5rs7uj9oc4";
        $commande2->created_at = "2021-11-12 20:07:00";
        $commande2->updated_at = "2021-11-12 20:07:00";
        $commande2->date_livraison = "2021-11-15 20:07:00";
        $commande2->etat = 1;
        $commande2->carte_id = 10;

        $commande3 = new commande;
        $commande3->id = "00thibaut10-2700-8866-9v8w-2g5rs7uj9oc4";
        $commande3->created_at = "2021-11-12 20:07:00";
        $commande3->updated_at = "2021-11-12 20:07:00";
        $commande3->date_livraison = "2021-11-15 20:07:00";
        $commande3->etat = 1;
        $commande3->carte_id = 10;
        //$commande->save();
        //$commande2->save();
        //$commande3->save();
        return commande::query()
            ->where("carte_id", "=", 10)
            ->where("created_at", "=", "2021-11-12 20:07:00")
            ->get();
    }

    public static function question10(){
        $commande= new commande();
        $commande::query()
            ->where("carte_id", "=", 3)
            ->update(["carte_id" => 11]);
        echo $commande::query()->where("carte_id", "=", 3)->get();
    }

    public static function question14(){
        $carte = new carte;
        $cartes = $carte::query()->where("mail_proprietaire", "like", "%Aaron.McGlynn%")->get();
        foreach ($cartes as $carte){
            echo $carte->commande()
                ->with('carte')
                ->where("etat", ">", 0)
                ->get();
        }
    }

    public static function question15(){
        $cartes = carte::query()->get();
        foreach ($cartes as $carte){
            $arrays = $carte->commande()
                    ->with('carte')
                    ->where("etat", ">", 0)
                    ->where("montant", ">", 20)
                    ->get();
            foreach ($arrays as $array){
                if ($array->carte->id === 28){
                    echo $array;
                }
            }
        }
    }

    public static function question17(){
        $carte = new carte;
        $cartes = $carte::query()->get();
        foreach ($cartes as $carte){
            $count = $carte->commande()
                ->with('carte')
                ->count();
            if ($count > 8){
                echo $carte;
            }
        }
    }

    public static function question20(){
        $carte = new carte;
        $cartes = $carte::query()->get();
        foreach ($cartes as $carte){
            echo $carte->commande()
                ->with('carte')
                ->where("montant", ">", 30)
                ->get();
        }
    }


}