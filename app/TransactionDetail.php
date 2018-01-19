<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TransactionDetail extends Model
{


    public function item()
    {
    	return $this->belongsTo(Item::class,"item_id","item_id");
    }

    /**
     * a detail belongs to a transaction
     *
     * @return     App\Transaction  
     */
    public function transaction()
    {
    	return $this->belongsTo(Transaction::class)->latest("date");
    }
}
