<?php

namespace App\Transactions;

Class PurchaseItem extends GeneralItem
{
	
	public function closing()
	{
		return  intval(
				$this->databaseItem->availableQuantity+
				$this->requestItem->quantity()
			);
	}

	public function buyingPrice()
	{
	

		return $this->weigh(
				$this->databaseItem->buyingPrice,
				$this->requestItem->transactedAt()
			);



	}

	public function sellingPrice()
	{

		return $this->weigh(
				$this->databaseItem->sellingPrice,
				$this->requestItem->currentPrice()
			);
	}

	public function weigh($currentPrice,$newPrice)
	{
		$currentPrice=intval($currentPrice);

		$newPrice=intval($newPrice);

		

		//if the prices are the same them its safe for us to to bother

		if ($currentPrice==$newPrice) {
			return $currentPrice;
		}

		//at this point we will will compute the aggregate
		$currentQuantity=intval($this->databaseItem->availableQuantity);

		$purchasedQuantity=intval($this->requestItem->quantity());

		return round(
		
		($currentQuantity*$currentPrice +$newPrice*$purchasedQuantity)/
		($currentQuantity+$purchasedQuantity),2);
		
	}
	
}