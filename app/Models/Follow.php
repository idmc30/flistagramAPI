<?php

namespace App\Models;

class Follow extends Model
{

	protected $table = 'comment';
	protected $fillable = array(
		"idComment",
		"text",
		"idUser",
		"idPublication",
		"created_at",
	);

	protected $primaryKey = 'idComment';
/*	protected $hidden = [ 'idPublication' ];*/

	public function user ()
	{
		return $this->hasOne('App\Models\User', 'idUser', 'idUser');
	}
}
