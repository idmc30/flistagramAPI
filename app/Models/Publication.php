<?php

namespace App\Models;

class Publication extends Model
{

	protected $table = 'publication';

	protected $fillable = array(
		"id_publication",
		"id_user",
		"description",
		"location",
		"created_at",
	);

	protected $primaryKey = 'id_publication';

	protected $hidden = [ 'updated_at' ];

	public function comments ()
	{
		return $this->hasMany('App\Models\Comment', 'id_publication', 'id_publication');
	}

	public function photo ()
	{
		return $this->hasOne('App\Models\Photo', 'id_publication', 'id_publication');
	}

	public function user ()
	{
		return $this->hasOne('App\Models\User', 'id_user', 'id_user');
	}

	public function likes ()
	{
		return $this->hasMany('App\Models\Like', 'id_publication', 'id_publication');
	}

}
