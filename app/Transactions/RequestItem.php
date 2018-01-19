<?php

namespace App\Transactions;

Class RequestItem
{
	protected $raw;

	public function __construct($raw)
	{
		$this->raw=$raw;
	}

	public function __call($method,$args)
	{
		return $this->raw[$method];
	}
	
}