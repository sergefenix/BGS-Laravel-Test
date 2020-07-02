<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Participant extends Model
{
    protected $fillable = [
        'name', 'email', 'surname', 'event_id'
    ];

    /**
     * @return HasOne
     */
    public function event(): HasOne
    {
        return $this->hasOne(Event::class);
    }

    /**
     * @param $id
     *
     * @return string
     */
    public function getEventIdAttribute($id): string
    {
        return Event::find($id) ? Event::find($id)->name : '';
    }

}
