<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $guarded = [];

    public function User()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // relasi ke penerima pesan (recipient_id)
    public function Recipient()
    {
        return $this->belongsTo(User::class, 'recipient_id');
    }
}
