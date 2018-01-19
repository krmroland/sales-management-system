<?php

namespace App\Filters;

Trait IsFilterable
{
	public function scopefilter($builder, BaseFilter $filters)
	{
		return $filters->apply($builder);
	}
	
}