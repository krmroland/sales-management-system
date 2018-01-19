<?php

namespace App\Transactions;

use App\Item;

Class PriceDifference
{
	protected $databaseItem;

	protected $requestItem;

	public function __construct(Item $databaseItem,$requestItem)
	{
		$this->databaseItem=$databaseItem;

		$this->requestItem=$requestItem;
	}

	public function current()
	{
		return[

		"buyingPrice"=>$this->databaseItem->buyingPrice,
		"sellingPrice"=>$this->databaseItem->sellingPrice
		];
	}


	public function new()
	{
		return [
		 "buyingPrice"=>intval($this->requestItem->transactedAt()),
		 "sellingPrice"=>intval($this->requestItem->currentPrice())
		];
	}

	/**
	 * determins if prices are the same
	 *
	 * @return     boolean
	 */
	public function areTheSame()
	{
		return !! empty($this->difference());
	}

	/**
	 * The prices before the transaction
	 *
	 * @return     array
	 */
	public function before()
	{
		  return array_diff($this->current(),$this->new());
	}

	/**
	 * the prices after the transaction
	 *
	 * @return     array
	 */
	public function after()
	{
		 return array_diff($this->new(),$this->current());
	}	
	/**
	 * computes the difference between the curerent prices and new prices
	 *
	 * @return       array|null
	 */
	public function difference()
	{
		return array_diff($this->new(),$this->current());
	}
}