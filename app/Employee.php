<?php

namespace App;

use App\Images\Image;
use App\Filters\IsFilterable;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
	use IsFilterable;

	protected $appends=["image"];

    /**
     * the mass assignable fields
     * @var array
     */
    protected $fillable=["name","responsibility","sex","phoneNumber"];

    /**
     * rules for  validatiing an employee
     *
     * @return     array  
     */
    public static function rules()
    {
    	return[
    	"name"=>"required",
    	"responsibility"=>"required|max:20",
    	"sex"=>"required",
    	"phoneNumber"=>"required|digits:10",

    	];
    }
    /**
     * Gets the image attribute.
     *
     * @return     \App\Services\Image  The image attribute.
     */
    public function getImageAttribute()
    {
    	return new Image("employees", "$this->id.jpg");
    }

    public function payments()
    {
    	return $this->hasMany(EmployeePayment::class)->latest("date");
    }
 
}
