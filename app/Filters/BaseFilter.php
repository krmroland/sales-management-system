<?php

namespace App\Filters;

use Illuminate\Http\Request;

abstract Class BaseFilter
{
	/**
	 * @var Illuminate\Database\Query\Builder
	 */
	protected $builder;
	/**
	 * @var Illuminate\Http\Request
	 */
	protected $request;


	protected $query;

	/**
	 * you must give us the searchable methods to call
	 * 
	 */
	abstract public function searchable();
	/**
	 * creates an instance of this clss
	 *
	 * @param      Request  $request  
	 */
	public function __construct(Request $request)
	{
		$this->request = $request;

		$this->query=$request->get("query");
	}
	/**
	 * apply the filters	
	 *
	 * @param      Builder  $builder  
	 */
	public function apply($builder)
	{
		$this->builder=$builder;

		if($this->isSearching()){
			$this->searchFields();
		}
		$this->filterRequest();

		return $this->builder;
	}
	
	/**
	 * merge all the filters
	 *
	 * @return     array  
	 */
	public function filters()
	{
	   return array_filter($this->request->all());
	}

	protected function filterRequest()
	{
		foreach ($this->filters() as $name=>$value) {
			if (method_exists($this,$name)) {
					$this->{$name}($value);
				}	
		}
	}

	public function searchFields()
	{
		foreach ($this->searchable() as $field) {
			$this->builder->orWhere("$field","like","%$this->query%");
		}

		if (method_exists($this,"dates")) {
			
			foreach ($this->dates() as $date) {
				$this->builder->whereDate("$date","like","%$this->query%");
			}
		}
	}

	/**
	 * Determines if searching.
	 *
	 * @return     boolean  
	 */
	public function isSearching()
	{
		return $this->request->has("query");
	}
}