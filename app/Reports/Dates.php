<?php

namespace App\Reports;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

Class Dates
{
	/**
	 * @var string
	 */
	protected $single;

	/**
	 * @var string
	 */
	protected $range;

	public function __construct(Request $request)
	{
		$this->processDate($request->date?:date("Y-m-d"));

	}

	/**
	 * the ending point of a range
	 *
	 * @return     string  
	 */
	public function single()
	{
		return $this->single;
	}

	public function type()
	{
		if (isset($this->range)) {
			return "range";
		}
		return "daily";
	}

	public function isRange()
	{
		return count($this->range)==2;
	}
	

	public function from()
	{
		return $this->extractfromRange("from");
	}
	public function to()
	{
		return $this->extractfromRange("to");
	}

	protected function extractfromRange($key)
	{
		if (isset($this->range[$key])) {
			return $this->range[$key];
		}
		return null;
	}

	

	/**
	 * Determines if has range.
	 * 
	 * @param  string
	 * 
	 * @return     boolean  True if range, False otherwise.
	 */
	public function hasRange($date)
	{
		return Str::contains($date, "to") ||Str::contains();
	}

	/**
	 * process a given date string
	 *
	 * @param      string  $date   
	 *
	 * @return     self    
	 */
	protected function processDate($dateString)
	{
		if (Str::contains($dateString, "to")) {
			
			return 	$this->makeFromRange($dateString);
		}
		if (Str::startsWith($dateString,"Week")) {

			return $this->makeFromWeeks($dateString);
		}

		$this->single=$dateString;

		return $this;
	}

	protected function makeFromRange($date)
	{
		$dates=explode("to", $date);

		return $this->setRange($dates[0],$dates[1]);
	}

	protected function makeFromWeeks($dateString)
	{
		
		$date=explode(",",strtr($dateString,["Week"=>""," "=>"","#"=>'']));

		$date= (new Carbon())->setISODate($date[1],$date[0]);

		$this->setRange($date->format("Y-m-d"),$date->addWeek()->format("Y-m-d"));
		

	}
	protected function setRange($from,$to)
	{
		
		$this->range["from"]=trim($from);

		$this->range["to"]=trim($to);

		return $this;
	}

}