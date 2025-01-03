<?php

namespace App\Models;

use Illuminate\Container\Attributes\Storage;
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
    public function getAttachmentFamilyRegisterAttribute($value)
    {
        if (!empty($value) && !is_null($value)) {
            return asset("storage/uploads/family_registers/" . $value);  // Menggunakan helper asset() untuk path file
        }
    }
    public function getAttachmentBirthCertificateAttribute($value)
    {
        if (!empty($value) && !is_null($value)) {
            return asset("storage/uploads/birth_certificates/" . $value);  // Menggunakan helper asset() untuk path file
        }
    }
    public function getAttachmentDiplomaAttribute($value)
    {
        if (!empty($value) && !is_null($value)) {
            return asset("storage/uploads/diplomas/" . $value);  // Menggunakan helper asset() untuk path file
        }
    }
}
