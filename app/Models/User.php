<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Notifications;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
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

    public function unread_notifications()
    {
        return $this->hasMany(Notifications::class)->where('status', 0)->whereNull('deleted_at');
    }

    public static function _find($id, $with = [])
    {
        return User::with($with)
            ->where('user_type', 'user')
            ->whereNull('deleted_at')
            ->where('id', $id)
            ->first();
    }

    public static function _findAll($with = [])
    {
        return User::with($with)
            ->where('user_type', 'user')
            ->whereNull('deleted_at')
            ->get();
    }
}
