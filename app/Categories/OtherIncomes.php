<?php

namespace App\Categories;

use Illuminate\Validation\Rule;

Class OtherIncomes implements Categorical
{
	
	public function rules()
	{
		return [
		'name' => ["required","max:20",Rule::unique('Categories')->where(function ($query) {
		    $query->where('subject', "otherIncomes");
		})]

		];
		
	}

	public function attributes($request)
	{
		return
		[
			"subject"=>"otherIncomes",
			"name"=>$request->name,
		];
		
	}
	
}