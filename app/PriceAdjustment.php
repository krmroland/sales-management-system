<?php

namespace App;

use App\Transactions\GeneralItem;

use Illuminate\Database\Eloquent\Model;

class PriceAdjustment extends Model
{
   /**
    * @var arra
    */
   protected $casts=["before"=>"array","after"=>"array"];

   /**
    * the mass assignable fields
    * @var array
    */
   protected $fillable=["before","after","transaction_id","item_id"];

   public $timestamps=false;
   
   /**
    * make a record of the adjustment 
    *
    * @param      \App\Transactions\GeneralItem  $item            
    * @param      integer                         $transaction_id  
    *
    * @return     array                          
    */
   protected static function make(GeneralItem $item,$transaction_id)
   {
   	
   		if ($item->prices()->areTheSame()) {
   			return [];
   		}

   		return [
   			"transaction_id"=>$transaction_id,
   			"before"=>json_encode($item->prices()->before()),
   			"after"=>json_encode($item->prices()->after()),
   			"item_id"=>$item->id()
   		];
   }

   public function item()
   {
   		return $this->belongsTo(Item::class,"item_id","item_id");
   }

   

}
