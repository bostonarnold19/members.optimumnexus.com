<?php

namespace Modules\User\Entities;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Zizaco\Entrust\Traits\EntrustUserTrait;

class User extends Authenticatable
{
    use HasApiTokens, EntrustUserTrait, Notifiable;

    public $fillable = [
        'email',
        'password',
        'first_name',
        'last_name',
        'middle_name',
        'profile_picture',
        'scraper_affiliate_number',
        'status',
        'wp_site',
        'address',
        'mobile',
        'telephone',
        'birthdate',
        'username',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function subscriptions()
    {
        return $this->hasMany('Modules\User\Entities\Subscription');
    }

    public function categories()
    {
        return $this->hasMany('Modules\Category\Entities\Category');
    }
}
