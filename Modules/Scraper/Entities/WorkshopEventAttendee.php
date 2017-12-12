<?php

namespace Modules\Scraper\Entities;

use Illuminate\Database\Eloquent\Model;

class WorkshopEventAttendee extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'event_id', 
        'first_name',
        'last_name',
        'time',
        'phone',
        'address1',
        'address2',
        'city',
        'zip',
        'email',
        'state',
        'country',
        'tags'
    ];

}
