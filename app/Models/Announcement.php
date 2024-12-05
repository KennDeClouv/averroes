<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    protected $guarded = ['id'];

    public function target()
    {
        return $this->belongsTo(Role::class, 'target_id');
    }
}
