<?php

namespace App\Hydrators;

use App\HasDates;

use Illuminate\Database\Eloquent\Model;

Class Hydrator extends Model
{
	use HasDates;
	/**
	 * class is used for hydrating model records only and doesnot hit the database
	 * in fact we set the table to null
	 */
	protected $table=null;
	
}