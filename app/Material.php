<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    protected $table = 'materials';

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
        'mod_id',
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
