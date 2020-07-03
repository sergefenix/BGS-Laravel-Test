<?php

namespace App\Http\Controllers\Api;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Collection;

class UserController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return User[]|Collection
     */
    public function index()
    {
        return  User::all();
    }
}
