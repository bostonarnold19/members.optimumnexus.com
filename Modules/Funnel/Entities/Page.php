<?php

namespace Modules\Funnel\Entities;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    public $fillable = [
        'user_id',
        'title',
        'description',
        'link',
        'page_id',
        'type',
    ];

    public function user()
    {
        return $this->belongsTo('Modules\User\Entities\User');
    }
}
