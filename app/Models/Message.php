<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $guarded = [];

    public function User() {
        $this->belongsTo(User::class);
    }
    public function Recipient() {
        $this->belongsTo(User::class);
    }
}
