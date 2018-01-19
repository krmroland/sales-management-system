<?php

namespace App;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;

class Company  implements \JsonSerializable
{

	/**
	 * dynamically get a property fromthe configuration
	 *
	 * @param      string  $property  
	 *
	 * @return     mixed  
	 */
	public function __get($property)
	{
		return Config::get("company.$property");
	}

	public function all()
	{
		return Config::get("company");
	}

	public function jsonSerialize()
	{

		return Cache::rememberForever("company.configuration",function(){

			return $this->all()+
					["parking"=>$this->parking()]+
					["otherIncomes"=>$this->otherIncomes()]+
					["categories"=>$this->categories()]+
					["expenditure"=>$this->expenditure()];	
		});
		
	}

	public function parking()
	{
		return Cache::rememberForever("categories.parking",function (){
		   return Category::ofType("parking")->get(); 
		});
		
	}

	public function otherIncomes()
	{
		return Cache::rememberForever("categories.otherIncome",function (){
		   return Category::ofType("otherIncomes")->get(); 
		});
	}

	public function categories()
	{
		return Cache::rememberForever("categories.all",function(){
			return 

			 [
				"parking"=>$this->parking()->keyBy("id")->map(function ($category,$key){
				    return "$category->name (".$category->data["fee"].")";
				}),

				"items"=>["Eats","Drinks"],
				"rooms"=>["Single","Double","tripple","Quadripple"],
				"otherIncomes"=>$this->otherIncomes()->sortBy("name")->pluck("name")
			];
		});

	}

	public function expenditure()
	{
		return [
			"employees"=>[
				"types"=>["wage","salary","allowance","medical","other"],
				"intervals"=>["hourly","daily","weekly","monthly","other"]
			],
			"bills"=>["yaka","dstv","water"],
			"general"=>["food","airtime","transport","other"]
		];
	}
}
