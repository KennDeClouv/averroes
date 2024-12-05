<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $fillable = ['user_id', 'feature_id'];
    public function User()
    {
        return $this->belongsTo(User::class);
    }
    public function Feature()
    {
        return $this->belongsTo(Feature::class);
    }
}
