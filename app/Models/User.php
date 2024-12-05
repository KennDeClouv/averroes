<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'photo',
        'is_active',
        'role_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }
    public function Role()
    {
        return $this->belongsTo(Role::class);
    }
    private function getConsistentColor()
    {
        $hash = md5($this->name ?? 'Guest');
        $color = substr($hash, 0, 6);

        return $color;
    }
    public function getPhotoAttribute($value)
    {
        if (!empty($value) && !is_null($value)) {
            return $value;
        }
        $randomColor = $this->getConsistentColor();
        $name = $this->name ?? 'Imam';

        return "https://api.dicebear.com/6.x/initials/svg?seed=" . urlencode($name) . "&backgroundColor=" . $randomColor;
    }

    public function Permissions()
    {
        return $this->hasMany(Permission::class);
    }

    public function getPermissionCodes()
    {
        if ($this->Admin && $this->is_active == true) {
            $codes = $this->Permissions
                ? $this->Permissions->pluck('Feature.code')
                : collect([]);

            if ($codes->contains('all_feature')) {
                return Feature::pluck('code');
            }
            return $codes;
        } else {
            return collect([]);
        }
    }
    public function Student()
    {
        return $this->hasOne(Student::class);
    }
    public function Teacher()
    {
        return $this->hasOne(Teacher::class);
    }
}
