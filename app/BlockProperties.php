<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BlockProperties extends Model
{
    protected $table = 'block_properties';

    protected $fillable = [
        'block_id',
        'key',
        'value',
        'parameters',
        'attribute'
    ];

    public function block()
    {
        return $this->belongsTo('App\Block');
    }

}
