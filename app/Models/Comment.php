<?php

namespace App\Models;

class Comment extends Model
{

    protected $table = 'comment';
    protected $fillable = array(
        "id_comment",
        "text",
        "id_user",
        "id_publication",
        "created_at",
    );
    protected $primaryKey = 'id_comment';

    /*	protected $hidden = [ 'idPublication' ];*/

    public function user()
    {
        return $this->hasOne('App\Models\User', 'id_user', 'id_user');
    }
}
