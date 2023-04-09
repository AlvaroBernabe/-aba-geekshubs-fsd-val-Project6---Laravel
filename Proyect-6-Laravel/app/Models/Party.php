<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Party extends Model
{
    use HasFactory;


    public function games()
    {
        return $this->hasOne(Game::class);
    }



    public function users()
    {
        return $this->hasMany(User::class);
    }
}
