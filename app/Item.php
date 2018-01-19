<?php

namespace App;

use App\Items\Bundler;
use App\Filters\IsFilterable;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use IsFilterable;

	/**
	 * @var array
	 */
	protected $appends=[
        "bundle","buyingPrice","sellingPrice","availableQuantity"
    ];
	
    /**
     * unique indentifier
     * @var string
     */
    protected $primaryKey="item_id";

    /**
     * the mass assignable fields
     * @var array
     */
    protected $fillable=[
	    "name","category",'unitName','bundleName','unitsPerBundle'
    ];

    /**
     * search the items
     *
     * @param      \Illuminate\Database\Eloquent\Builder  $builder  
     * @param      string  $name     
     *
     * @return     \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSearch($builder,$name)
    {
    	return $builder->where("name","like","%$name%")->oldest("name")
                       ->limit(10);
    }
    /**
     * Gets the bundle attribute.
     *
     * @return     Bundler  
     */
    public function getBundleAttribute()
    {
    	return (new Bundler($this));
    }

    /**
     * the items summary
     *
     * @return     Summary  
     */
    public static function  summary()
    {
    	return  app(\App\Summaries\Items::class);
    }

    public static function boot()
    {
        static::addGlobalScope(function ($builder){
            return $builder->with("variables");
        });
    }

    public function variables()
    {
        return $this->hasOne(ItemVariable::class,"item_id","item_id");
    }
    public function getAvailableQuantityAttribute()
    {
        $variables=$this->variables;


        return $variables?$variables->quantity:0;
        
    }
    public function getSellingPriceAttribute()
    {
        $variables=$this->variables;

        return $variables?$variables->sellingPrice:0;
        
    }
    public function getBuyingPriceAttribute()
    {
        $variables=$this->variables;

        return $variables?$variables->buyingPrice:0;
    }

    public function adjustVariables($adjustments)
    {

        if ($this->variables) {
            return $this->variables()->update($adjustments);
        }
        return $this->variables()->create($adjustments);
    }
    public function persist($attributes=[])
    {
        $this->withoutGlobalScopes()->create($attributes);

        return $this;
    }

    public function transactionDetails()
    {
        return $this->hasMany(TransactionDetail::class,"item_id","item_id")->limit(200);
    }

   
   public function delete()
   {
     DB::transaction(function(){
            $this->variables()->delete();
            $transaction_ids=$this->transactionDetails()->pluck("transaction_id");
            DB::table("transaction_details")->whereIn("transaction_id",$transaction_ids)->delete();
            DB::table("transactions")->whereIn("id",$transaction_ids)->delete();
            parent::delete();
     });
   
   }
}
