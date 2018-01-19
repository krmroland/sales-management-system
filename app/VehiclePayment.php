<?php

namespace App;

use App\Filters\IsFilterable;
use Illuminate\Database\Eloquent\Model;

class VehiclePayment extends Model
{
   use HasDates,IsFilterable;

   protected $appends=["description"];

   protected $dates=["date"];
   /**
    * the mass assignable fields
    * @var array
    */
   protected $fillable=["date","paid"];


   public function make($vehicle,$details)
   {
   		$this->fill($details);

   		$this->vehicle_id=$vehicle->vehicle_id;

   		$this->fee=$vehicle->fee;

   		$this->balanceBefore=$vehicle->accountBalance;

   		$this->balanceAfter=$vehicle->accountBalance-$this->fee+$this->paid;

   		$this->save();

         saveLog($this,"parking");

   		return $this;

   }



   public function vehicle()
   {
   		return $this->belongsTo(Vehicle::class,"vehicle_id","vehicle_id");
   }

   public function getDescriptionAttribute()
   {
     return "recorded  ".number_format($this->fee)."/=";
   }

}
