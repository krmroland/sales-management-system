<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ItemVariable extends Model
{
    public $timestamps=false;

    protected $fillable=["quantity","buyingPrice","sellingPrice"];
}
