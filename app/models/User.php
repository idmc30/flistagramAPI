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
	protected $hidden = [ 'password', 'updated_at' ];

}
