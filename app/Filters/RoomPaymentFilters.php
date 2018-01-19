<?php

namespace App\Filters;

Class RoomPaymentFilters extends BaseFilter
{
	
	public function searchable()
	{
		
		return [];
	}

	public  function miniHistory()
	{
		return $this->history()->limit(10)->select(["ammount","name","number"]);
	}

	public function fullHistory()
	{
		return $this->history()->limit(200)->selectRaw("*,room_payments.id as payment_id");
	}

	protected  function history()
	{
			return $this->builder
			              ->latest("room_payments.created_at")
			              ->join("rooms","room_payments.room_id","rooms.id");
			              
	}
	
}