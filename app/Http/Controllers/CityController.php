<?php

namespace App\Http\Controllers;

use App\City;
use Illuminate\Contracts\Support\Renderable;

class CityController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return Renderable
     */
    public function index(): Renderable
    {
        $cities = City::paginate(10);
        return view('cities', compact(['cities']));
    }
}
