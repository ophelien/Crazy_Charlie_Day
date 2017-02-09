<?php

namespace collocation\models;

use \collocation\models\Appartient;

class User extends \Illuminate\Database\Eloquent\Model {
    protected $table = "user";
    protected $primaryKey = "email";
    public $timestamps = false;

    public function estGerant(){
        $appartients = Appartient::where("email","=",$this->email)->get();
        foreach ($appartients as $appartient){
            if($appartient->urlGestion != null){
                return true;
            }
        }
        return false;
    }
}

