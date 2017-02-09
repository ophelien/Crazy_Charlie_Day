<?php

namespace collocation\models;

class Appartient extends \Illuminate\Database\Eloquent\Model {
    protected $table = "appartient";
    protected $primaryKey = "id";
    public $timestamps = false;

    public function user(){
        return User::where("email","=",$this->email)->first();
    }
}