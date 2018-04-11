<?php

namespace App\Models;

class Photo extends Model
{

	protected $table = 'photo';
	protected $fillable = array(
		"idPhoto",
		"pathPhoto",
		"idPublication",
		"created_at",
	);
	protected $primaryKey = 'idPhoto';
/*	protected $hidden = [ 'password' ];*/

}