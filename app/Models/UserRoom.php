<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserRoom extends Model
{
    use HasFactory;
    
    protected $table = 'users_rooms';

    public function user()
{
    return $this->belongsTo(User::class);
}
}
