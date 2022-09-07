<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Video;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'last_name',
        'birthday',
        'national_code',
        'phone',
        'company',
        'company_registration_number',
        'company_type',
        'state',
        'city',
        'image',
        'company_exact_address',
        'postal_code',
        'activity',
        'limited',
        'card_number',
        'is_admin',
        'is_vip',
        'email',
        'password',
        'username',
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
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    // each vip user can have many videos
    public function videos()
    {
        return $this->hasMany(Video::class);
    }

    public function viewViews()
    {
        return $this->belongsToMany(Video::class, 'users_videos');
    }
}
