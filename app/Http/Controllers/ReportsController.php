<?php

namespace App\Http\Controllers;

use App\Reports\Compiler;

use Illuminate\Http\Request;

class ReportsController extends Controller
{
    public function index(Request $request)
    {
    	return view("pages.reports");
    	
    }

    public function generate(Compiler $compiler)
    {
    
    	return $compiler->summary();
    }
}
