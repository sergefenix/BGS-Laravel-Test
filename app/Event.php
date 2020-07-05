<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Event extends Model
{
    protected $fillable = ['name', 'date_start', 'city_id'];

    /**
     * @return HasOne
     */
    public function city(): HasOne
    {
        return $this->hasOne(City::class);
    }

    /**
     * @param $id
     *
     * @return string
     */
    public function getCityIdAttribute($id): string
    {
        return City::find($id) ? City::find($id)->name : '';
    }
}
