<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $fillable = ['name'];

    /**
     * @return int
     */
    public function countEvents(): int
    {
        return Event::where('city_id', $this->id)->count() ?? 0;
    }
}
