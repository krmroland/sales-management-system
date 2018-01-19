<?php

namespace App\Http\Controllers;

use App\Employee;
use Illuminate\Http\Request;
use App\Filters\EmployeeFilters;

class EmployeesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(EmployeeFilters $filters,Request $request)
    {
        if ($request->wantsJson()) {

            return Employee::filter($filters)->oldest("name")->get();
        }

        return view("employees.index");
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
        $request->validate(Employee::rules());
        return  Employee::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {
        $employee->load("payments");
        
        return view("employees.show",compact("employee"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit(Employee $employee)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Employee $employee)
    {
        $request->validate(Employee::rules($employee));

        $employee->update($request->all());

        return $employee;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee)
    {
        //saveLog($employee,"deleted_employee");

        $employee->delete();

    }




    public function avatar(Employee $employee)
    {
        return view("employees.avatars.create",compact("fielder"));
    }


    public function uploadAvatar(Request $request , Employee $employee)
    {
        $this->validate($request,["avatar"=>"required|image"]);

        $employee->imagePath->load($request->avatar)->makeThumbnail(70,70);

        flash("Upload was successfull");

        return redirect()->route("employees.show",$employee);
    }
}
