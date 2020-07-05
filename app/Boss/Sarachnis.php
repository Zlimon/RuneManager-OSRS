<?php

namespace App\Boss;

use Illuminate\Database\Eloquent\Model;

class Sarachnis extends Model
{
    protected $fillable = [
        'obtained',
        'kill_count',
        'sraracha',
        'jar_of_eyes',
        'giant_egg_sac(full)',
        'sarachnis_cudgel',
    ];

    protected $hidden = ['user_id'];
}
