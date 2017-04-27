<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Perfiles extends Model
{
    protected $table = "Perfiles";
    
    public $timestamps = false;
    public $incrementing = false;

	protected $fillable = [

		'id',
		'descripcion',
		
		];
}