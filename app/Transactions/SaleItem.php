<?php

namespace App\Transactions;

Class SaleItem extends GeneralItem
{
	
	public function closing()
	{
		return intval(
				$this->databaseItem->availableQuantity-
				$this->requestItem->quantity()
			);
	}

	public function buyingPrice()
	{
		return $this->databaseItem->buyingPrice;
	}

	public function sellingPrice()
	{
		return $this->databaseItem->sellingPrice;
	}
}