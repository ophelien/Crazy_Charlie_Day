<?php

namespace collocation\models;

class Logement extends \Illuminate\Database\Eloquent\Model {
    protected $table = "logement";
    protected $primaryKey = "idLogement";
    public $timestamps = false;
}

