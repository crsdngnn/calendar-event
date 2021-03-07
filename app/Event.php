<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model
{
    use SoftDeletes;

    /*
        Mass Assignables
    */
    protected $fillable = [
        'title',
        'date_from',
        'date_to',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function hasManyEventDetails() {
        return $this->hasMany('App\EventDetail');
    }

}
