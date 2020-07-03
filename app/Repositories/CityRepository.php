<?php

namespace App\Repositories;

use App\City;

class CityRepository extends BaseRepository
{

    /**
     * @return mixed
     */
    public function model()
    {
       return City::class;
    }

    /**
     * @param array $data
     *
     * @return mixed
     */
    public function create(array $data)
    {
        return City::create([
            'name' => $data['name'],
        ]);
    }

    /**
     * @param City  $city
     * @param array $data
     *
     * @return mixed
     */
    public function update(City $city, array $data)
    {
        $city->fill([
            'name' => $data['name'],
        ]);

        return $city->save();
    }

}
