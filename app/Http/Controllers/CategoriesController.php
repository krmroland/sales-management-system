<?php

namespace App\Http\Controllers;

use App\Category;

use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function store(Request $request,Category $category,$type)
    {
    	$request->validate($category->rules($type));

    	return $category->persist($type,$request);
    }

    public function destroy($category)
    {

        Category::whereId($category)->delete();

        cache()->flush();
    }
}
