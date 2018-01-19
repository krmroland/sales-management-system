<?php

namespace App\Items;

use App\Item;

Class Bundler implements \JsonSerializable
{
	protected $item;
	/**
	 * instatiate the bundler class
	 *
	 * @param      \App\Item  $item   
	 */
	public function __construct($item)
	{
		$this->item=$item;
	}
	/**
	 * the compond Name  eg 14 sodas => 1 crate and 2 bottles
	 *
	 * @return     string
	 */
	public function name()
	{
		//if we have no quantity then we are probably not going to 
		//bother our computer instead we will abort immediately
		
    	if (!$this->isBundled() || $this->isLessThanABundle()) {
    		return $this->pieces($this->item->availableQuantity);
    	}
    	
    	if ($this->item->availableQuantity<=0) {
    		return;
    	}


    	return $this->compoundName();
	}
	/**
	 * the compound name of the bundles
	 *
	 * @return    string
	 */
	protected function compoundName()
	{
		$pieces=$this->item->availableQuantity%$this->item->unitsPerBundle;

		if (!$pieces) {
			return $this->bundles();
		}

		return sprintf("%s and %s",$this->bundles(),$this->pieces($pieces));
	}

	/**
	 * the pluralized pieces in a bundles
	 *
	 * @param      integer $pieces The pieces
	 *
	 * @return    string
	 */
	protected function pieces($pieces)
	{
		return $this->pluralize($pieces, $this->item->unitName);
	}
	/**
	 * the pluralized version of the bundles
	 *
	 * @return     string  
	 */
	protected function bundles()
	{
		$bundles=floor($this->item->availableQuantity/$this->item->unitsPerBundle);

		return $this->pluralize($bundles, $this->item->bundleName);
	}
	/**
	 * Determines if bundled.
	 *
	 * @return     boolean  
	 */
	protected function isBundled()
	{
		return !! ($this->item->bundleName);
		
	}
	/**
	 * Determines if less than a bundle.
	 *
	 * @return     boolean  
	 */
	protected function isLessThanABundle()
	{
		return !! ($this->item->availableQuantity<$this->item->unitsPerBundle);
	}
	/**
	 * pluralize the qunatity eg 1 crate or 2 crates
	 *
	 * @param      string  $count   
	 * @param      string  $string  
	 *
	 * @return     string  ( description_of_the_return_value )
	 */
	protected function pluralize($count, $string)
	{
		return $count." ". str_plural($string,$count);
	}

	public function jsonSerialize()
	{
		return[
			"name"=>$this->name(),
			"unitPlural"=>str_plural($this->item->unitName),
			"bundlePlural"=>str_plural($this->item->bundleName?:'')

		];
	}
}