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

	/*
	|---------------------------------------------------------------------------------------------------
	| Create
	|---------------------------------------------------------------------------------------------------
	*/
	public function create ()
	{
		//DB connection and create user
	}
}
