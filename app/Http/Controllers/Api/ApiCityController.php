<?php

namespace App\Http\Controllers\Api;

use App\City;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Database\Eloquent\Collection;

class ApiCityController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return City[]|Renderable|Collection
     */
    public function index()
    {
        return City::all();

    }
}
