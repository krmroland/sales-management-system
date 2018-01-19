<?php

namespace App\Hydrators;



Class Parking extends Hydrator
{

	protected $appends=["debt"];


	protected $table=null;

	public function getDebtAttribute()
	{
		return $this->cashCollected-$this->cashExpected;
	}
	
}