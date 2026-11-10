<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Fillable(['name', 'email', 'password'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    public const ROLE_PELANGGAN = 'pelanggan';
    public const ROLE_KASIR = 'kasir';
    public const ROLE_OWNER = 'owner';

    public const ROLES = [self::ROLE_PELANGGAN, self::ROLE_KASIR, self::ROLE_OWNER];

    /**
     * Nama route dashboard sesuai role user.
     */
    public function dashboardRoute(): string
    {
        return $this->role.'.dashboard';
    }

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
            'is_langganan' => 'boolean',
        ];
    }
    public function orders()
{
    return $this->hasMany(Order::class);
}
}
