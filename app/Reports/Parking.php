<?php

namespace App\Reports;

use Illuminate\Support\Facades\DB;

use App\Hydrators\Parking as Hydrator;

Class Parking extends BaseReport
{
	public function builder()
	{
		return DB::table("vehicle_payments");
	}
	
	public function summary()
	{
		$items=Hydrator::hydrate($this->query()->all());

		$cashCollected=$items->sum("cashCollected");
		
		return [
			"items"=>$items->groupBy("date"),
			"cashCollected"=>$cashCollected,
			"cashExpected"=>$items->sum("cashExpected"),
			"debt"=>$items->sum("debt"),
			"profit"=>"$cashCollected",
		];
		
	}
	
	public function details()
	{
		
	}

	public function query()
	{
		return $this->prepareQuery()
		            ->join("vehicles","vehicle_payments.vehicle_id","vehicles.vehicle_id")
		            ->select(DB::raw("
		            		category ,
							sum(vehicle_payments.fee) as cashExpected,
							sum(paid) as cashCollected,
							count(*) as vehicle_count,
							icon,
							date
		            	"))->groupBy("category")->get();
	}
}