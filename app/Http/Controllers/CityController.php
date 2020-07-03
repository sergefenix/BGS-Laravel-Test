<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use App\Repositories\CityRepository;
use App\City;

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

        return view('cities.index', compact(['cities']));
    }

    /**
     * @param City $city
     *
     * @return RedirectResponse
     */
    public function delete(City $city): RedirectResponse
    {
        $this->cityRepository->delete($city->id);

        return redirect()->route('cities');
    }
}
