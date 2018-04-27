<?php

namespace App\Models;

class Follow extends Model
{

    protected $table = 'connection';
    protected $fillable = array(
        "id_connection",
        "id_follower",
        "id_to_follow",
        "created_at",
    );

    protected $primaryKey = 'id_connection';

/*    protected $hidden = ['created_at', "id_follower", "id_to_follow", 'updated_at'];*/

    public function follower()
    {
        return $this->hasOne('App\Models\User', 'id_user', 'id_follower');
    }

    public function followed()
    {
        return $this->hasOne('App\Models\User', 'id_user', 'id_to_follow');
    }
}
