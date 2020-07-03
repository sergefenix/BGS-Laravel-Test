<?php

namespace App\Http\Controllers;

use App\Repositories\CityRepository;
use Illuminate\Contracts\Support\Renderable;

class CityController extends Controller
{
    /**
     * @var CityRepository
     */
    private $cityRepository;

    /**
     * CityController constructor.
     *
     * @param CityRepository $cityRepository
     */
    public function __construct(CityRepository $cityRepository)
    {
        $this->cityRepository = $cityRepository;
    }

    /**
     * Show the application dashboard.
     *
     * @return Renderable
     */
    public function index(): Renderable
    {
        $cities = $this->cityRepository->paginate(10);

        return view('cities', compact(['cities']));
    }
}
