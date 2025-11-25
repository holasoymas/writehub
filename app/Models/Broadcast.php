<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Broadcast extends Model
{
    protected $fillable = ['title', 'message', 'send_at', 'total_send'];

    protected $casts = ['send_at' => 'datetime'];
}
