<?php

namespace App\Rooms;

use App\Room;

Class Rates
{
	protected $room;

	protected $rates=[];

	public function __construct(Room $room)
	{
		$this->room=$room;

		$this->setRates($room->rates);
	}
	

	public function add($rate)
	{
		if ($this->exists($rate)) {
			throw new \Exception(
					$this->name($rate).
					" rate already exists! Edit it instead if you want to change it");
		}

		return $this->updateOrCreate($rate);
	}

	public function remove($name)
	{

		unset($this->rates[$name]);

		return $this->save();

	}

	protected function updateOrCreate($rate)
	{
		$this->rates[$this->name($rate)]=$rate["ammount"];

		return $this->save();
	}

	public function update($name,$rate)
	{
		$this->rates[$name]=$rate["ammount"];
		return $this->save();

	}

	public function exists($rate)
	{
		return array_has($this->rates,$rate["name"]);
	}

	public function name($rate)
	{
		return strtolower($rate["name"]);
	}

	public function get($name)
	{
		return $this->rates[strtolower($name)];
	}

	

	public function setRates($rates)
	{
		if ($rates) {
			$this->rates=$rates;
		}
		return $this;

	}

	public function save()
	{
		$this->room->rates=$this->rates;

		$this->room->save();

		return $this->room;
	}
}