<?php

namespace App\Boss;

use Illuminate\Database\Eloquent\Model;

class TheGauntlet extends Model
{
    protected $fillable = [
        'obtained',
        'kill_count',
        'crystal_armour_seed',
        'blade_of_saeldor_(inactive)',
        'gauntlet_cape',
        'kill_count',
        'obtained',
        'crystal_weapon_seed',
        'youngllef',
    ];

    protected $hidden = ['user_id'];
}