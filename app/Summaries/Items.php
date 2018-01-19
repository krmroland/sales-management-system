<?php

namespace App\Summaries;


use App\Item;
use App\ItemVariable;


Class Items implements \JsonSerializable
{

	public function jsonSerialize()
	{
		return $this->summarizedItems();
		
	}

    protected function summarizedItems()
    {


        $total_count=Item::count();

        $variables=ItemVariable::selectRaw("
            sum(buyingPrice*quantity) as beforeSale,
            sum(sellingPrice*quantity) as afterSale
            ")->get()->first()->toArray();

        return array_merge(compact("total_count"),$variables);

    }
}