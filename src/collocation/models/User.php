<?php

namespace collocation\models;

class User extends \Illuminate\Database\Eloquent\Model {
    protected $table = "user";
    protected $primaryKey = "email";
    public $timestamps = false;
}

