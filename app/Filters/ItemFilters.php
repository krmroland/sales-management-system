<?php

namespace App\Filters;

Class ItemFilters extends BaseFilter
{
	public function searchable()
	{
		return ["name","unitName","bundleName"];
	}
	
}