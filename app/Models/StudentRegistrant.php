<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentRegistrant extends Model
{
    protected $guarded = [];


    public function getAttachmentFamilyRegisterAttribute($value)
    {
        if (!empty($value) && !is_null($value)) {
            return asset($value);  // Menggunakan helper asset() untuk path file
        }
    }
    public function setAttachmentFamilyRegisterAttribute($value)
    {
        if (!empty($value) && !is_null($value)) {
            $this->attributes['attachment_family_register'] = $value;  // Set the value directly to the attribute
        } else {
            $this->attributes['attachment_family_register'] = null;  // Set to null if the value is empty or null
        }
    }

    public function User()
    {
        return $this->belongsTo(User::class);
    }
}
