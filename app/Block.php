<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Block extends Model
{
    protected $table = 'blocks';

    protected $fillable = [
        'name',
        'count',
        'damage_category',
        'surface_category',
        'particle_category',
        'destroy_category',
        'forge_category',
        'hardness',
        'stepsound',
        'lightopacity',
        'stability_glue',
        'mass',
        'plant',
        'stability_support',
        'collidable',
        'ground_cover',
        'movement_factor',
        'explosion_resistance',
        'alpha',
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

    public function mod()
    {
        return $this->belongsTo('App\Mods');
    }

    public function properties()
    {
        return $this->hasMany('App\BlockProperties');
    }


}
