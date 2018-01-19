<?php

namespace App\Http\Controllers;

use App\RoomPayment;
use App\VehiclePayment;
use Illuminate\Http\Request;
use App\Filters\RoomPaymentFilters;
use App\Filters\VehiclePaymentFilters;

class PagesController extends Controller
{
    

    public function bar()
    {
    	return view("pages.bar");
    }

    public function accomodation(Request $request)
    {
        if ($request->wantsJson()) {
            
          return RoomPayment::filter(resolve(RoomPaymentFilters::class))->get();

        }
    	return view("pages.accomodation");
    }

    public function configuration()
    {
    	return view("pages.configuration");
    }

    public function parking(Request $request)
    {
        if ($request->wantsJson()) {
            
            return VehiclePayment::filter(resolve(VehiclePaymentFilters::class))->get();

        }

        return view("pages.parking");
    }

    
}
