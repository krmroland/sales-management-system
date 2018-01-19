<?php

namespace App\Reports;

use App\Hydrators\Salaries as Hydrator;

use Illuminate\Support\Facades\DB;

Class Salaries extends BaseReport
{
	
	public function builder()
	{
		return DB::table("employee_payments");
	}

	public function summary()
	{
		$items=Hydrator::hydrate($this->query()->all());

		return [

			"items"=>$items->groupBy("date"),
			"expenditure"=>$items->sum("paid")
		];
	}

	public function details()
	{
		
	}
	
	protected function query()
	{
		return $this->prepareQuery()
		           ->select(DB::raw("date,type,interval,count(*) as salary_count,sum(ammount) as paid"))
		           ->groupBy("type")->get();
	}
}