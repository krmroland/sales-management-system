<?php

namespace App\Reports;

use App\Reports\Dates;
use Illuminate\Support\Facades\DB;

abstract Class BaseReport
{

	protected $dates;

	public function __construct(Dates $dates)
	{
		$this->dates=$dates;

	}


	abstract public function details();


	abstract public function summary();

	abstract public function builder();
	

	public function prepareQuery($dateColumn="date")
	{

		if ($this->dates->isRange()) {
			return $this->builder()->whereDate($dateColumn,">=",$this->dates->from())
						  ->whereDate($dateColumn,"<=",$this->dates->to())->latest($dateColumn);
		}
		return $this->builder()->whereDate($dateColumn,$this->dates->single())->latest($dateColumn);
	}
	
}