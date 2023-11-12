<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RestaurantLaravelTestController extends Controller
{
    public function index()
    {
        return view('restaurant-laravel-test');
    }
}
