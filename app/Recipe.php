<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    //
    protected $table = 'recipes';

    protected $fillable = [
        'name',
        'count',
        'craft_xp',
        'learn_xp',
        'craft_area',
        'craft_tool',
        'craft_time',
        'scrapable',
        'core',
        'user_id'
    ];

    /*
     * A recipe is owned by a user
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
