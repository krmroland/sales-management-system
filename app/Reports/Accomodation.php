<?php

namespace App\Reports;

use App\Hydrators\Accomodation as Hydrator;

use Illuminate\Support\Facades\DB;

Class Accomodation extends BaseReport
{

	public function summary()
	{
		$items=$this->query()->select(DB::raw("
			number,
			name,
			sum(ammount) as cashCollected,
			rateName,
			sum(units) as totalUnits,
			date
		"))->groupby("number")->groupBy("rateName")->get();

		$items=Hydrator::hydrate($items->all());
		$cashCollected=$items->sum("cashCollected");
		return [
			"items"=>$items->groupBy("date"),
			"cashCollected"=>$cashCollected,
			"profit"=>$cashCollected
		];
	}

	public function details()
	{
		
	}


	public function builder()
	{
		return DB::table("room_payments");
	}

	public function query()
	{
		return $this->prepareQuery()
		->join("rooms","room_payments.room_id","rooms.id");
	}
	
}