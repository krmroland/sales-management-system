<?php

namespace App\Categories;

Interface Categorical
{
	
	public function rules();

	public function attributes($request);
}