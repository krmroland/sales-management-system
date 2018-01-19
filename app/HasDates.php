<?php

namespace App;

Trait HasDates
{
	
	/**
	 * Gets the date attribute.
	 *
	 * @param      string  $date   
	 *
	 * @return     string  The date attribute.
	 */

	public function getDateAttribute($date)
	{
		return $this->asDateTime($date)->format("D d-m-Y ");
	}

	public function getCreatedAtAttribute($date)
	{
		return $this->asDateTime($date)->diffForHumans();
	}
	
}
