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

	protected $primaryKey = 'idFollow';

	/*	protected $hidden = [ 'idPublication' ];*/

	public function userFollower ()
	{
		return $this->hasOne('App\Models\User', 'idUser', 'idFollower');
	}

	public function userToFollow ()
	{
		return $this->hasOne('App\Models\User', 'idUser', 'idToFollow');
	}
}
