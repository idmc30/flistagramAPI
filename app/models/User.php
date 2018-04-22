<?php

namespace App\Models;

class User extends Model
{

    protected $table = 'user';
    protected $fillable = array(
        "idUser",
        "username",
        "name",
        "password",
        "email",
        "pathPhotoAvatar",
    );

    protected $primaryKey = 'idUser';
    protected $hidden = ['password', 'updated_at','created_at'];


    public function publications()
    {
        return $this->hasMany('App\Models\Publication', 'idUser', 'idUser');
    }

    public function followers()
    {
        return $this->hasMany('App\Models\Follow', 'idToFollow', 'idUser');
    }

    public function followed()
    {
        return $this->hasMany('App\Models\Follow', 'idFollower', 'idUser');
    }

}
