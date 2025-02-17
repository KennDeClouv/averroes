<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentRegistrant extends Model
{
    protected $guarded = [];
    public function User()
    {
        return $this->belongsTo(User::class);
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
    public function getAttachmentFatherIdentityCardAttribute($value)
    {
        if (!empty($value) && !is_null($value)) {
            return asset("storage/uploads/father_identity_cards/" . $value);  // Menggunakan helper asset() untuk path file
        }
    }

    public function getAttachmentMotherIdentityCardAttribute($value)
    {
        if (!empty($value) && !is_null($value)) {
            return asset("storage/uploads/mother_identity_cards/" . $value);  // Menggunakan helper asset() untuk path file
        }
    }
}
