<?php

namespace App;

use App\Rooms\Rates;
use App\Filters\IsFilterable;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use IsFilterable;
    /**
     * the mass assignable fields
     * @var array
     */
    protected $fillable=["name","size","number"];
    /**
     * cast the following fields to arrays
     *
     * @var        array
     */
    protected $casts=["rates"=>"array"];

    
    /**
     * rules fro creating an array
     *
     * @return     array  
     */
    public static function rules()
    {
    	return [
    		"name"=>"required|unique:rooms",
    		"size"=>"required",
    		"number"=>"required|unique:rooms",
    		];
    	
    }

    /**
     * Gets the rates attributes.
     *
     * @param      string  $rates  The rates
     *
     * @return     App\Rooms\Rates
     */
    public function rates()
    {
    	return new Rates($this);
    }

    public function payments()
    {
        return $this->hasMany(RoomPayment::class);
    }

    public function pay($details)
    {
        return app(RoomPayment::class)->make($this,$details);
    }

    public function delete()
    {
        $this->payments()->delete();

        parent::delete();
    }
}
