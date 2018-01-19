<?php

namespace App\Transactions;

use App\Item;

use App\PriceAdjustment;


abstract Class GeneralItem
{
	abstract public function closing();
	abstract public function buyingPrice();
	abstract public function sellingPrice();
	/**
	 * The items from the request
	 */

	protected $requestItem;
	/**
	 * The matching items in the database
	 */
	protected $databaseItem;

	/**
	 * { function_description }
	 *
	 * @param      \App\Item  $databaseItem   In database
	 * @param      <type>     $requestItem  The from request
	 */
	public function __construct(Item $databaseItem,RequestItem $requestItem)
	{
		$this->databaseItem=$databaseItem;

		$this->requestItem=$requestItem;
	}

	public function transactionDetail($transaction_id)
	{
		return [

		"transaction_id"=>$transaction_id,
		"item_id"=>$this->id(),
		"transactedAt"=>$this->requestItem->transactedAt(),
		"currentPrice"=>$this->requestItem->currentPrice(),
		"opening"=>$this->databaseItem->availableQuantity,
		"closing"=>$this->closing(),
		"new"=>$this->requestItem->quantity()

		];
	}
	

	public function priceAdjustment($transaction_id)
	{
		return PriceAdjustment::make($this,$transaction_id);
	}

	public function prices()
	{
		return new PriceDifference($this->databaseItem,$this->requestItem);
	}

	public function id()
	{
		return $this->databaseItem->getKey();
	}

	public function variable()
	{
		return [
			"item_id"=>$this->id(),
			"buyingPrice"=>$this->buyingPrice(),
			"sellingPrice"=>$this->sellingPrice(),
			"quantity"=>$this->closing()
		];
	}
}