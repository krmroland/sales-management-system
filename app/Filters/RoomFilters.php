<?php

namespace App\Filters;

Class RoomFilters extends BaseFilter
{
	
	public function searchable()
	{
		return [
		"number",
		"name",
		];
	}
	
}