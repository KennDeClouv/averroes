<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PushSubscription extends Model
{
    protected $fillable = ['data', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
