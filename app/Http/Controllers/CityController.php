<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Contracts\View\Factory;
use App\Repositories\EventRepository;
use Illuminate\Http\RedirectResponse;
use App\Repositories\CityRepository;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\City;

class CityController extends Controller
{
    /**
     * @var CityRepository
     */
    private $cityRepository;

    /**
     * @var EventRepository
     */
    private $eventRepository;

    /**
     * CityController constructor.
     *
     * @param CityRepository  $cityRepository
     * @param EventRepository $eventRepository
     */
    public function __construct(CityRepository $cityRepository, EventRepository $eventRepository)
    {
        $this->cityRepository = $cityRepository;
        $this->eventRepository = $eventRepository;
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
     * @return Application|Factory|View
     */
    public function create(): Renderable
    {
        return view('cities.create');
    }

    /**
     * @param Request $request
     *
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $this->cityRepository->create($request->input());

        return redirect()->route('cities');
    }

    /**
     * @param City $city
     *
     * @return Application|Factory|View
     */
    public function edit(City $city): Renderable
    {
        return view('cities.edit', compact('city'));
    }

    /**
     * @param City    $city
     * @param Request $request
     *
     * @return Application|Factory|View
     */
    public function update(City $city, Request $request): Renderable
    {
        $city = $this->cityRepository->update($city, $request->input());

        return view('cities.show', compact(['city']));
    }

    /**
     * @param City $city
     *
     * @return Application|Factory|View
     */
    public function show(City $city): Renderable
    {
        $events = $this->eventRepository->where('city_id', $city->id);

        return view('cities.show', compact(['city', 'events']));
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
