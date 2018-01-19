<?php

namespace App\Transactions;

use App\Item;

use Illuminate\Http\Request;

Class AllItems
{
	protected $items=[];

	protected $type;



	public function __construct(Request $request)
	{

		$this->type=$request->type;

		$this->raw=json_decode($request->items,true);
		$this->setItems();
	}

	public function all()
	{
		return $this->items;
	}
	

	protected function setItems()
	{
	  Item::findMany(array_keys($this->raw))->map(function ($inDatabase){
		   $this->items[]= $this->generateItem($inDatabase);
		});
	}

	protected function generateItem($inDatabase)
	{
		return $this->type=="sale"?
				new SaleItem(...$this->attributes($inDatabase)):
				new PurchaseItem(...$this->attributes($inDatabase));
		
	}

	protected function attributes($inDatabase)
	{
		return[
			$inDatabase,
			
			new RequestItem($this->raw[$inDatabase->getKey()])
		];
	}
}