<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model{
    protected $table = "users";
    protected $fillable=[
        'id',"nombre", "ape_pat", "ape_mat", "email",
        "username", "password", "img", "rol", "remember_token"
    ];
    protected $hidden = [];

    public $timestamps = false;
}

