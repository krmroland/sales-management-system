<?php

namespace App\Hydrators;


use App\Items\Bundler;


Class Purchases extends Hydrator
{


	protected $appends=["profitExpected","debt","bundle"];

	protected $fillable=[
		"item_id", "name","category",'unitName','bundleName','unitsPerBundle',
		'availableQuantity','date','cashPurchased','expenditure','cashExpected'
		];


	/**
	 * Gets the bundle attribute.
	 *
	 * @return     Bundler  
	 */
	public function getBundleAttribute()
	{
		return (new Bundler($this));
	}

	public function getProfitExpectedAttribute()
	{
		return $this->cashExpected-$this->cashPurchased;
	}
	public function getDebtAttribute()
	{
		return $this->cashPurchased-$this->expenditure;
	}


}