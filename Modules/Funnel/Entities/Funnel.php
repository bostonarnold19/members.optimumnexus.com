<?php

namespace Modules\Funnel\Entities;

use Illuminate\Database\Eloquent\Model;

class Funnel extends Model
{
    public $fillable = [
        'user_id',
        'title',
        'description',
    ];

    public function user()
    {
        return $this->belongsTo('Modules\User\Entities\User');
    }

    public function pages()
    {
        return $this->belongsToMany('Modules\Funnel\Entities\Page');
    }
}
