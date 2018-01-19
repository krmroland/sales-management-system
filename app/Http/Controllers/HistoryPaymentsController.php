<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HistoryPaymentsController extends Controller
{
    public function rooms()
    {
    	return RoomPayment::history();
    }
}
