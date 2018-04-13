<?php

namespace Modules\Category\Entities;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';

    public $fillable = [
        'name',
        'description',
        'user_id',
        'type',
    ];

    public function user()
    {
        return $this->belongsTo('Modules\User\Entities\User');
    }

    public function funnels()
    {
        return $this->hasMany('Modules\Funnel\Entities\Funnel');
    }
}
