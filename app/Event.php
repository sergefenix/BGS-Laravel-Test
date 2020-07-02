<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Event extends Model
{
    protected $fillable = ['name', 'date_start'];

    /**
     * @return HasOne
     */
    public function city(): HasOne
    {
        return $this->hasOne(City::class);
    }

    public function getCityIdAttribute($id)
    {
        return City::find($id) ? City::find($id)->name : '';
    }
}
