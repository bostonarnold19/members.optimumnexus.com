<?php

namespace Modules\User\Entities;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    public $fillable = [
        'user_id',
        'product_name',
        'status',
        'payment_type',
        'expired_at',
    ];
}
