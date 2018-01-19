<?php

namespace App\Categories;

Class Parking implements Categorical
{
	
	public function rules()
	{
		return [
		"name"=>"required|max:25",
		"fee"=>"required|numeric",
		"icon"=>"required|unique:categories"

		];
		
	}

	public function attributes($request)
	{
		return
		[
			"subject"=>"parking",
			"name"=>$request->name,
			"data"=>$request->except("name")
		];
		
	}
}