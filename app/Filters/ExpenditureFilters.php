<?php

namespace App\Filters;

Class ExpenditureFilters extends BaseFilter
{
	
	public function searchable()
	{
		return [
		"ammount",
		"description",
		"category",
		"type"
		];
	}

	public function dates()
	{
		return ["date"];
	}
	
}