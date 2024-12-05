<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Classes extends Model
{
    protected $fillable = ['name', 'code'];

    public function Students()
    {
        return $this->hasMany(Student::class);
    }
    public function Teachers()
    {
        return $this->hasMany(Teacher::class);
    }
}
