<?php

namespace Modules\User\Entities;

use Illuminate\Database\Eloquent\Model;

class UserClient extends Model
{
    protected $table = 'user_clients';

    public $fillable = [
        'first_name',
        'last_name',
        'email',
    ];
}
