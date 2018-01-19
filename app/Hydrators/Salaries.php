<?php

namespace App\Hydrators;

Class Salaries extends Hydrator
{
	

	/**
	 * the mass assignable fields
	 * @var array
	 */
	protected $fillable=["type"];


	public function getTypeAttribute($type)
	{
		return str_plural($type);
	}
	
}