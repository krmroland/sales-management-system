<?php

namespace App\Reports;

use App\Hydrators\Hydrator;

use Illuminate\Support\Facades\DB;

Class Expenditure extends BaseReport
{

	public function summary()
	{
		$items=$this->query()->select(DB::raw("
			category,
			sum(ammount) as expenditure,
			type,
			date
		"))->groupby("category")->groupBy("type")->get();

		$items=Hydrator::hydrate($items->all());

		return [
			"items"=>$items->groupBy("date"),
			"expenditure"=>$items->sum("expenditure")
		];
	}

	public function details()
	{
		
	}


	public function builder()
	{
		return DB::table("expenditures");
	}

	public function query()
	{
		return $this->prepareQuery();
	}
	
}