<?php

namespace App\Models;

class Follow extends Model
{

    protected $table = 'connection';
    protected $fillable = array(
        "idConnection",
        "idFollower",
        "idToFollow",
        "created_at",
    );

    protected $primaryKey = 'idConnection';

    protected $hidden = ['created_at', "idFollower", "idToFollow", 'updated_at'];

    public function follower()
    {
        return $this->hasOne('App\Models\User', 'idUser', 'idFollower');
    }

    public function followed()
    {
        return $this->hasOne('App\Models\User', 'idUser', 'idToFollow');
    }
}
