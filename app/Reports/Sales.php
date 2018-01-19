<?php

namespace App\Reports;


use App\Item;
use App\Hydrators\Sales as Hydrator;
use Illuminate\Support\Facades\DB;


Class Sales extends BaseReport
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
			"profit"=>$items->sum("profit"),
			"debt"=>$items->sum("debt"),
			"cashCollected"=>$items->sum("cashCollected"),
			"cashPurchased"=>$items->sum("cashPurchased"),
			"cashSold"=>$items->sum("cashSold")
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
		              ->where("transactions.type","sale")
		              ->select(DB::raw("
		              	items.name,
		              	items.unitName,
		              	items.bundleName,
		              	items.unitsPerBundle,
		              	transactions.date,
		              	sum(currentPrice*new) as cashPurchased,
						sum(transactedAt*new) as cashSold,
						sum (new) availableQuantity,
						sum(paid) as cashCollected
	
		              	"))->groupBy("items.name")->get();
	}
	
}