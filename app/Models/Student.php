<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $guarded = [];
    public function User()
    {
        return $this->belongsTo(User::class);
    }
    public function Room()
    {
        return $this->belongsTo(Room::class);
    }
    public function Classes()
    {
        return $this->belongsTo(Classes::class);
    }
    public function StudentPermits()
    {
        return $this->hasMany(StudentPermit::class);
    }
}
