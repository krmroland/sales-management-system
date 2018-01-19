<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class ConfigurationsController extends Controller
{
    public function index()
    {
    	return view("configurations.index");
    }

    public function store(Request $request,Category $category,$type)
    {
    	$request->validate($category->rules($type));

    	return $category->persist($type,$request);
    }
}
