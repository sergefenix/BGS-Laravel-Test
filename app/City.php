<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $fillable = ['name'];

    public function countEvents()
    {
        return Event::where('city_id', $this->id)->count() ?? 0;
    }
}
