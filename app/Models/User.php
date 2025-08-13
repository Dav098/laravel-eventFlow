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
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
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
    public function hasRole($role)
    {
        return $this->role === $role || $this->role === 'user/promoter';
    }

    public function isPromoter(): bool
    {
        return in_array($this->role, ['promoter', 'user/promoter']);
    }

    public function isUser(): bool
    {
        return in_array($this->role, ['user', 'user/promoter']);
    }

    public function isOnlyUser()
    {
        return $this->role === 'user';
    }

    public function events()
    {
        return $this->hasMany(Event::class, 'organizer_id');
    }



}
