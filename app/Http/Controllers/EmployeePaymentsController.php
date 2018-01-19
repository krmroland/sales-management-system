<?php

namespace App\Http\Controllers;

use App\EmployeePayment;
use App\Employee;
use Illuminate\Http\Request;

class EmployeePaymentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function store(Request $request,Employee $employee)
    {
        $request->validate(EmployeePayment::rules());

        return EmployeePayment::pay($employee,$request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\EmployeePayment  $salary
     * @return \Illuminate\Http\Response
     */
    public function show(EmployeePayment $salary)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\EmployeePayment  $salary
     * @return \Illuminate\Http\Response
     */
    public function edit(EmployeePayment $salary)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\EmployeePayment  $salary
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EmployeePayment $salary)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\EmployeePayment  $salary
     * @return \Illuminate\Http\Response
     */
    public function destroy(EmployeePayment $salary)
    {
        //
    }
}
