<?php

namespace App\Reports;


use App\Item;
use App\Hydrators\Purchases as Hydrator;
use Illuminate\Support\Facades\DB;


Class Purchases extends BaseReport
{

	public function builder()
	{
		return DB::table("transactions");
	}

	public function summary()
	{

		$items=Hydrator::hydrate($this->query()->all());
		return [
			"items"=>$items->groupBy("date"),
			"debt"=>$items->sum("debt"),
			"expenditure"=>$items->sum("expenditure"),
			"cashExpected"=>$items->sum("cashExpected"),
			"profitExpected"=>$items->sum("profitExpected"),
			"cashPurchased"=>$items->sum("cashPurchased")
		];
		
	}

	public function details()
	{

	}

	public function query()
	{
		return  $this->prepareQuery()
		              ->leftJoin("transaction_details","transactions.id","transaction_details.transaction_id")
		              ->join("items","items.item_id","transaction_details.item_id")
		              ->where("transactions.type","purchase")
		              ->select(DB::raw("
		              	items.name,
		              	items.unitName,
		              	items.bundleName,
		              	items.unitsPerBundle,
		              	transactions.date,
		              	sum(transactedAt*new) as cashPurchased,
						sum(currentPrice*new) as cashExpected,
						sum (new) availableQuantity,
						sum(paid) as expenditure
	
		              	"))->groupBy("items.name")->get();
	}
	
}