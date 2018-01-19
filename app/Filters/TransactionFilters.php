<?php

namespace App\Filters;

use App\Filters\BaseFilter;

Class TransactionFilters extends BaseFilter
{
	
	public function searchable()
	{
		return [];
		
	}

	public function dates()
	{
		return ["date"];
	}


	public function type($type)
	{
		return $this->builder->where("type",$type);
	}

	
}