<?php

namespace App\Http\Controllers;

use App\OtherIncome;
use Illuminate\Http\Request;

class OtherIncomesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->wantsJson()) {
            
            return OtherIncome::latest("date")->limit(150)->get();
        }
        return view("pages.otherIncomes");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(OtherIncome::rules());

        $otherIncome=OtherIncome::create(array_filter($request->all()));
        
        return saveLog($otherIncome,$otherIncome->category);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\OtherIncome  $otherIncome
     * @return \Illuminate\Http\Response
     */
    public function show(OtherIncome $otherIncome)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\OtherIncome  $otherIncome
     * @return \Illuminate\Http\Response
     */
    public function edit(OtherIncome $otherIncome)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\OtherIncome  $otherIncome
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, OtherIncome $otherIncome)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\OtherIncome  $otherIncome
     * @return \Illuminate\Http\Response
     */
    public function destroy(OtherIncome $otherIncome)
    {
        $otherIncome->delete();
    }
}
