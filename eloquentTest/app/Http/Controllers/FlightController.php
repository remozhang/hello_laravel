<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Flight;

class FlightController extends Controller
{
    //
    public function index() {
        $flights = Flight::where('active', 1)
            ->orderBy('name', 'desc')
            ->take(10)
            ->get();

    }

}
