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
	protected $hidden = [ 'password' ];

	/*
	|---------------------------------------------------------------------------------------------------
	| Create
	|---------------------------------------------------------------------------------------------------
	*/
	public function create ()
	{
		//DB connection and create user
	}

	public static function makePassword ( $password )
	{
		return hash('sha256', $password);
	}
}
