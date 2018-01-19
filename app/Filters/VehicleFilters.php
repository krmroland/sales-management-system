<?php

namespace App\Filters;

Class VehicleFilters extends BaseFilter
{

	public function searchable()
	{
		return ["numberPlate","owner","phoneNumber"];
	}
}