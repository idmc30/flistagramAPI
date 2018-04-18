<?php

namespace App\Models;

class Photo extends Model
{

	protected $table = 'photo';
	protected $fillable = array(
		"idPhoto",
		"pathPhoto",
		"idPublication",
		"publicPath",
		"created_at",
	);
	protected $primaryKey = 'idPhoto';
	protected $hidden = [ 'updated_at', 'pathPhoto', 'idPublication' ];

}