<?php

namespace App\Http\Controllers\Api;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Contracts\Support\Renderable;
use App\Http\Controllers\Controller;
use App\Repositories\CityRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
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
     * @return City[]|Renderable|Collection
     */
    public function index()
    {
        return $this->cityRepository->all();
    }

    /**
     * @param City $city
     *
     * @return JsonResponse|mixed
     */
    public function delete(City $city)
    {
        $this->cityRepository->delete($city->id);

        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
