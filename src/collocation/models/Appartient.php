<?php

namespace collocation\models;

class Appartient extends \Illuminate\Database\Eloquent\Model {
    protected $table = "appartient";
    protected $primaryKey = "email,idGroupe";
    public $timestamps = false;
}