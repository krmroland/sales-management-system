<?php

namespace App\Filters;

Class EmployeeFilters extends BaseFilter
{
	
	public function searchable()
	{
		return [
		"name",
		"phoneNumber",
		"responsibility"
		];
	}
	
}