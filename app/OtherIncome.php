<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OtherIncome extends Model
{
  protected $appends=["description"];

   use HasDates;

   /**
    * the mass assignable fields
    * @var array
    */
   protected $fillable=["date","cashCollected","profit","category"];




   public static function rules()
   {
   	 return [
   	 "date"=>"required",
   	 "cashCollected"=>"required|numeric",
   	 // "expenditure"=>"nullable|numeric",
   	 "category"=>"required",
   	 "profit"=>"nullable|numeric"
   	 ];
   }


   public function getDescriptionAttribute()
   {
     return "recorded ".number_format($this->cashCollected)."/=";
   } 
}
