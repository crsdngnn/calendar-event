<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EventDetail extends Model
{
    //
    use SoftDeletes;

    /*
        Mass Assignables
    */
    protected $fillable = [
        'event_id',
        'day_id',
    ];

    public function day() {
        return $this->belongsTo('App\Day');
    }
}
