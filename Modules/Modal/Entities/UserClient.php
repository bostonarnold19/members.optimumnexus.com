<?php

namespace Modules\Modal\Entities;

use Illuminate\Database\Eloquent\Model;

class UserClient extends Model
{
    protected $table = 'user_clients';

    public $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'email',
    ];
}
