<?php

namespace collocation\models;

class Groupe extends \Illuminate\Database\Eloquent\Model {
    protected $table = "groupe";
    protected $primaryKey = "idGroupe";
    public $timestamps = false;

    public function users(){
        $appartiens = Appartient::where("idGroupe","=",$this->idGroupe);
        $tab = array();
        foreach ($appartiens as $appartien){
            array_push($tab, $appartien->utilisateur());
        }
        return $tab;
    }

    public function nbMembre(){
        $appartiens = Appartient::all();
        return $appartiens.lengths;
    }
}