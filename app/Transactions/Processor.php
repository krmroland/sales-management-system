<?php

namespace App\Transactions;

use App\Transaction;
use App\ItemVariable;

use Illuminate\Support\Facades\DB;

Class Processor
{
	/**
	 * @var App\Transaction
	 */
	protected $transaction;

	protected $items=[];

	/**
	 * creates an instance of the Processor
	 *
	 * @param      \App\Transaction  $transaction  
	 * @param      string            $items        
	 */
	public function __construct(Transaction $transaction)
	{
		$this->transaction=$transaction;

		$this->items= app(AllItems::class)->all();

	}

	/**
	 * process the transactions
	 *
	 * @return     mixed 
	 */
	public function process()
	{
		
		$this->recordTransactionDetails()
		// ->recordPriceAdjsutments()
		->deleteItemVariables()
		->recreateItemVariables();
		
	}

	protected function recordTransactionDetails()
	{
		DB::table("transaction_details")
		->insert($this->collectAll("transactionDetail"));

		return $this;
	}
	// protected function recordPriceAdjsutments()
	// {

	// 	//we wont bother with prices when we are selling
	// 	if ($this->transaction->isPurchase()) {

	// 		DB::table("price_adjustments")
	// 		->insert(array_filter($this->collectAll("priceAdjustment")));
	// 	}
	// 	return $this;
	// }

	protected function deleteItemVariables()
	{
		ItemVariable::whereIn("item_id",$this->collectAll("id"))->delete();

		return $this;
	}

	protected function recreateItemVariables()
	{
		ItemVariable::insert($this->collectAll("variable"));

		return $this;
	}

	protected function collectAll($property)
	{
		$properties=[];
		foreach ($this->items as $item) {
			$properties[]=$item->{$property}($this->transaction->getKey());
		}
		return $properties;
	}

}