<?php

namespace App;

use App\Filters\IsFilterable;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use IsFilterable;

	/**
	 * unique indentifier
	 * @var string
	 */
	protected $primaryKey="vehicle_id";

	/**
	 * the mass assignable fields
	 * @var array
	 */
	protected $fillable=["numberPlate","owner","phoneNumber","accountBalance","national_id"];
	/**
	 * find vehicle by number plate
	 *
	 * @param      string  $numberPlate  
	 *
	 * @return     Self|null  
	 */
	public static function findNumberPlate($numberPlate)
	{
		return static::where("numberPlate",$numberPlate)->first();
	}
    /**
     * rules for validating a vehicle
     *
     * @return     array
     */
    public static function rules()
    {
        
        //todo
        //temploraly remove the unique fields for nin
    	return[
    	"numberPlate"=>"required",
    	"category_id"=>"required",
    	"owner"=>"required|max:25",
    	"phoneNumber"=>"required|digits:10",
        "national_id"=>"nullable|size:14"
    	];
    }

    public static function boot()
    {
    	static::creating(function ($vehicle){
    		$vehicle->addCategoryDetails();
    	});
    }

    public function addCategoryDetails()
    {
    	$category=app(Company::class)->parking()->where("id",request("category_id"))->first();

    	$this->category=$category->name;
    	$this->fee=$category["data"]["fee"];
    	$this->icon=$category["data"]["icon"];
    	$this->numberPlate=strtoupper($this->numberPlate);


    }

    public function hasAlreadyPaid($date)
    {
    	return $this->payments()->whereDate("date",$date)->exists();
    }

    public function payments()
    {
    	return $this->hasMany(VehiclePayment::class,"vehicle_id","vehicle_id")->latest("date");
    }

    public function pay($attributes)
    {
    	return \DB::transaction(function() use($attributes){

    		return $this->updateBalance(app(VehiclePayment::class)->make($this,$attributes));

    	});
    	
    }

    public function updateBalance($payment)
    {
    	$this->accountBalance=$payment->balanceAfter;

    	$this->save();

    	return ["paid"=>$payment->paid,"numberPlate"=>$this->numberPlate];

    }


    public function delete()
    {
        $this->payments()->delete();

        parent::delete();
    }

    public function setNationalIdAttribute($national_id)
    {
       $this->attributes["national_id"]=strtoupper($national_id);
    }
}
