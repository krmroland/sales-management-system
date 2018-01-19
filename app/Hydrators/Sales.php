<?php

namespace App\Hydrators;

use App\Items\Bundler;


Class Sales extends Hydrator
{


	protected $appends=["bundle","profit","debt"];
	
	protected $fillable=[
		"item_id", "name","category",'unitName','bundleName','unitsPerBundle',
		'availableQuantity','date','cashPurchased','cashCollected','cashSold'
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

		public function getProfitAttribute()
		{
			return $this->cashSold-$this->cashPurchased;
		}
		public function getDebtAttribute()
		{
			return $this->cashCollected-$this->cashPurchased;
		}
	
}