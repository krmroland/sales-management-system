<?php

namespace App\Reports;

use App\Hydrators\Hydrator;
use Illuminate\Support\Facades\DB;

Class OtherIncomes extends BaseReport
{
	public function builder()
	{
		return DB::table("other_incomes");
	}

	public function summary()
	{
		$items=Hydrator::hydrate($this->query()->all());
		return [
			"items"=>$items->groupBy("date"),
			"cashCollected"=>$items->sum("cashCollected"),
			"profit"=>$items->sum("profit"),

		];
	}

	public function details()
	{
		
	}
	

	protected function query()
	{
		return $this->prepareQuery()->selectRaw("
				count(*) as  income_count,
				category,
				date,
				sum(profit) as profit,
				sum(cashCollected) as cashCollected
				")->groupBy("category")->groupBy("category")->get();
	}
}