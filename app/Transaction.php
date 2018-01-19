<?php

namespace App;

use App\Processors\Logger;
use App\Filters\IsFilterable;
use App\Transactions\Processor;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
  use IsFilterable,HasDates;
	/**
	 * the mass assignable fields
	 * @var array
	 */
	protected $fillable=["date","ammount","paid","type"];

  protected $appends=["description"];

  protected $dates=["date"];
  
  public static $snakeAttributes=false;


  public function make($attributes)
  {
    DB::transaction(function ()use($attributes){
      $this->fill(array_filter($attributes))->save();
      (new Processor($this))->process();
      app(Logger::class)->log($this,$this->type);

    });


  }

  public function isSale()
  {
   return $this->type=="sale";
 }

 public function isPurchase()
 {
   return $this->type=="purchase";
 }
    /**
     * a transaction has many details
     *
     * @return     Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function details()
    {
      return $this->hasMany(TransactionDetail::class,"transaction_id");
    }
    /**
     * a transaction can adjust prices
     *
     * @return     Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function priceAdjustments()
    {
      return $this->hasMany(PriceAdjustment::class,"transaction_id");
    }

    public function getDescriptionAttribute()
    {
      $description=$this->type=="sale"?"Sold Items ":"Purchased Items";
      return sprintf("%s worth %s",$description,number_format($this->ammount));
    }

    public function delete()
    {
      \DB::transaction(function(){
        $this->priceAdjustments()->delete();
        $this->details()->delete();
        parent::delete();
      });
    
    }
  }
