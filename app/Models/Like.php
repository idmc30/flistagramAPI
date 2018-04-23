<?php

namespace App\Models;

class Like extends Model
{

    protected $table = 'like';
    protected $fillable = array(
        "id_like",
        "id_user",
        "id_publication",
        "created_at",
        "state"
    );
    protected $primaryKey = 'id_like';
    protected $hidden = ['id_publication', 'id_like', 'created_at', 'updated_at'];

    public function user()
    {
        return $this->hasOne('App\Models\User', 'id_user', 'id_user');
    }

    public function publication()
    {
        return $this->hasOne('App\Models\User', 'id_publication', 'id_publication');
    }
}
