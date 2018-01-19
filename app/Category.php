<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
	/**
	 * the mass assignable fields
	 * @var array
	 */
	protected $fillable=["name","subject","data"];

	/**
	 * cast these fields to and frpm json
	 *
	 * @var        array
	 */
	protected $casts=["data"=>"array"];

	public $timestamps=false;

	/**
	 * dynamically figure out the rules based on the type
	 *
	 * @param      string  $type   
	 *
	 * @return     array   
	 */
    public function rules($type)
    {
    	return $this->factory($type)->rules();
    }
    /**
     * persist the request data to storage
     *
     * @param      string  $type        
     * @param      array  $attributes  
     *
     * @return     Self 
     */
    public function persist($type,$request)
    {
    	cache()->flush();
    	return $this->create($this->factory($type)->attributes($request));
    	
    }

    public function scopeOfType($builder,$type)
    {
    	return $builder->where("subject",$type);
    }

    public function factory($type)
    {
    	switch ($type) {
    		case "parking":
    			return app(\App\Categories\Parking::class);
            case "otherIncomes":
                return app(\App\Categories\OtherIncomes::class);
    		default:
    			throw new \Exception("Category Not Found");
    	}
    }
}
