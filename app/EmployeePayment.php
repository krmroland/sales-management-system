<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmployeePayment extends Model
{
    /**
     * unique indentifier
     * @var string
     */
    protected $primaryKey="employee_id";

    protected $appends=["description"];

	use HasDates;
    /**
     * the mass assignable fields
     * @var array
     */
    protected $fillable=["date","type","ammount","interval","description"];


    protected $dates=["date"];

    /**
     * pay an employee
     *
     * @param      App\Employee  $employee  
     * @param      array  $details   
     *
     * @return    self
     */
    public static function pay($employee,$details)
    {
    	return (new static($details))->process($employee);
    }

    /**
     * process a salary
     *
     * @param      App\App\Employee  $employee  
     *
     * @return   App\Employee
     */
    public function process($employee)
    {
    	$this->employee_id=$employee->id;

    	$this->save();

    	saveLog($this, "salary");
    	
    	return $employee->load("payments");
    }

    /**
     * the rules for validating a payment
     *
     * @return     array  
     */
    public  static function rules()
    {
    	return [
    	"date"=>"required",
    	"type"=>"required",
    	"interval"=>"required",
    	"description"=>"required|max:150",
    	"ammount"=>"required|numeric"
    	];
    }
    
    protected function getDescriptionAttribute()
    {
        return sprintf("(%s) of %s/=", $this->type, number_format($this->ammount));
    }
}
