<?php

namespace App\Models;

class Comment extends Model
{

	protected $table = 'comment';
	protected $fillable = array(
		"idComment",
		"text",
		"idUser",
		"idPublication",
		"created_at",
	);
	protected $primaryKey = 'idUser';
	protected $hidden = [ 'password' ];

}
