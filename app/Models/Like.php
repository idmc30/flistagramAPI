<?php

namespace App\Models;

class Like extends Model
{

	protected $table = 'like';
	protected $fillable = array(
		"idLike",
		"idUser",
		"idPublication",
		"created_at",
		"state"
	);
	protected $primaryKey = 'idLike';
/*	protected $hidden = [ 'idPublication' ];*/

	public function user ()
	{
		return $this->hasOne('App\Models\User', 'idUser', 'idUser');
	}

	public function publication ()
	{
		return $this->hasOne('App\Models\User', 'idPublication', 'idPublication');
	}
}
