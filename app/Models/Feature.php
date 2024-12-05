<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Feature extends Model
{
    protected $fillable = ['name', 'code'];
    public function Permissions()
    {
        return $this->hasMany(Permission::class);
    }
}
