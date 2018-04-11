<?php

namespace App\Models;

class Publication extends Model
{

	protected $table = 'publication';

	protected $fillable = array(
		"idPublication",
		"idUser",
		"description",
		"location",
		"created_at",
	);

	protected $primaryKey = 'idPublication';

	/*	protected $hidden = [ 'password' ];*/

	public function comments ()
	{
		return $this->hasMany('App\Models\Comment', 'idPublication', 'idPublication');
	}

	public function photo ()
	{
		return $this->hasOne('App\Models\Photo', 'idPublication', 'idPublication');
	}
}
