<?php

namespace App\Filters;

Class VehiclePaymentFilters extends BaseFilter
{
	
	public function searchable()
	{
		
		return [];
	}

	public  function miniHistory()
	{
		return $this->history()->limit(10)->select(["paid","vehicles.numberPlate","icon"]);
	}

	public function fullHistory()
	{
		return $this->history()->limit(200);
	}

	protected function history()
	{
		return 	$this->builder->latest("vehicle_payments.created_at")
		->join("vehicles","vehicle_payments.vehicle_id","vehicles.vehicle_id");

	}
	
}