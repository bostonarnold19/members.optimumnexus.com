<?php

namespace Modules\Scraper\Entities;

use Illuminate\Database\Eloquent\Model;

class Scraper extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 
        'imfurl',
        'phone',
        'address_1',
        'city',
        'zip_code',
        'other_data',
        'event_location_date',
        'event_name',
        'custom_url'


    ];

    public function attendees()
    {
        return $this->hasMany('Modules\Scraper\Entities\WorkshopEventAttendee', 'event_id');
    }

}
