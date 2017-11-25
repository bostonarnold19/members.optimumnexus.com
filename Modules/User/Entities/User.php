<?php

namespace Modules\User\Entities;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Zizaco\Entrust\Traits\EntrustUserTrait;

class User extends Authenticatable
{
    use EntrustUserTrait, Notifiable;

    public $fillable = [
        'email',
        'password',
        'first_name',
        'last_name',
        'middle_name',
        'profile_picture',
        'scraper_affiliate_number',
        'status',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function subscriptions()
    {
        return $this->hasMany('Modules\User\Entities\Subscription');
    }
}
