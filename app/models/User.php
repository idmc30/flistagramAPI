<?php

namespace App\Models;

class User extends Model
{
    protected $table = 'user';
    protected $fillable = array(
        "id_user",
        "username",
        "name",
        "password",
        "email",
        "path_photo",
        "name_file_photo",
    );
    protected $primaryKey = 'id_user';
    protected $hidden = ['password', 'updated_at', 'created_at', 'email', "name_file_photo"];
    public function publications()
    {
        return $this->hasMany('App\Models\Publication', 'id_user', 'id_user');
    }
    public function followers()
    {
        return $this->hasMany('App\Models\Follow', 'id_to_follow', 'id_user');
    }
    public function followed()
    {
        return $this->hasMany('App\Models\Follow', 'id_follower', 'id_user');
    }
}
