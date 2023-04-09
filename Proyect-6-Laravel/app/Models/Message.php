<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    public function parties()
    {
        return $this->hasOne(Party::class);
    }

    public function users()
    {
        return $this->hasOne(User::class);
    }
}
