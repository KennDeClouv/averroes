<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentPermit extends Model
{
    protected $guarded = [];

    public function Student()
    {
        return $this->belongsTo(Student::class);
    }

    public function Teacher()
    {
        return $this->belongsTo(Teacher::class);
    }
}
