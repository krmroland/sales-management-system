<?php

namespace App\Reports;

use Illuminate\Http\Request;

Class Compiler 
{

	protected $compiled=[];

	protected $request;

	/**
	 * creates an instance of of the compiler class
	 *
	 * @param      Request  $request  
	 */
	public function __construct(Request $request)
	{
		$this->request=$request;
	}
	/**
	 * compiles  the requested report for as long as it is defined
	 *
	 * @param      string      $report
	 *
	 * @throws     \Exception  Just in case the report is not defined
	 *
	 * @return     App\Reports\BaseReport
	 */
	protected function compile($report)
	{

		if (!array_has($this->reports(),$report)) {
			throw new \Exception("Report $report not found");
		}
		return resolve($this->reports()[$report]);
	}

	/**
	 * The compilable reports
	 *
	 * @return     array  
	 */
	protected function reports()
	{
		return [
			"sales"=>Sales::class,
			"purchases"=>Purchases::class,
			"parking"=>Parking::class,
			"accomodation"=>Accomodation::class,
			"expenditure"=>Expenditure::class,
			"salaries"=>Salaries::class,
			"otherIncomes"=>OtherIncomes::class,
		];

	}

	public function summary()
	{
		
		foreach ($this->request->items as $report) {
			$this->compiled[$report]=$this->compile($report)->summary();
		}

		return $this->compiled;
	}

	public function details()
	{
		
	}

}