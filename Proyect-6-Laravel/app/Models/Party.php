<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Party extends Model
{
    use HasFactory;


    // protected $fillable = [
    //     'name',
    //     'rules',
    //     'game_id'
    // ];




    public function games()
    {
        return $this->hasOne(Game::class);
    }



    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    public function party_user()
    {
        return $this->belongsToMany(Party::class);
    }

    public function reviews()
    {
        return $this->hasMany(Party_User::class);
    }

}
