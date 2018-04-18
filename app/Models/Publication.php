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

	protected $hidden = [ 'updated_at' ];

	public function comments ()
	{
		return $this->hasMany('App\Models\Comment', 'idPublication', 'idPublication');
	}

	public function photo ()
	{
		return $this->hasOne('App\Models\Photo', 'idPublication', 'idPublication');
	}

	public function user ()
	{
		return $this->hasOne('App\Models\User', 'idUser', 'idUser');
	}

	public function likes ()
	{
		return $this->hasMany('App\Models\Like', 'idPublication', 'idPublication');
	}

}
