<?php

namespace App;

use App\Filters\IsFilterable;

use Illuminate\Database\Eloquent\Model;

class Expenditure extends Model
{
 use HasDates,IsFilterable;

 protected $appends=["description"];

  	/**
  	 * the mass assignable fields
  	 * @var array
  	 */
  	protected $fillable=["date","category","type","ammount","description"];

  	/**
  	 * rules fro validationg an expenditure
  	 *
  	 * @return     array  
  	 */
  	public static function rules()
  	{
  		return[
      "date" => "required|date",
      "category" => "required",
      "type" => "required",
      "ammount" => "required|numeric",
      "description" => "required|max:100"
      ];
    }

    public function getDescriptionAttribute()
    {
        return sprintf("%s (%s) %s/=",$this->type,$this->category,number_format($this->ammount));

    }
    
  }
