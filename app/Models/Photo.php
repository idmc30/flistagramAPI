<?php

namespace App\Models;

class Photo extends Model
{

    protected $table = 'photo';
    protected $fillable = array(
        "id_photo",
        "path_photo",
        "id_publication",
        "public_path",
        "created_at",
    );
    protected $primaryKey = 'id_photo';
    protected $hidden = ['updated_at', 'path_photo', 'id_publication', 'created_at'];

}