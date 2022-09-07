<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Actor;
use App\Models\Writer;
use App\Models\UserVideo;

class Video extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'poster',
        'teaser',
        'video',
        'director',
        'genre',
        'justification',
        'release',
        'price',
        'country',
        'discountFromUser',
        'discountFromProgram',
        'user_id',
        'views',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function actors()
    {
        return $this->hasMany(Actor::class);
    }

    public function writers()
    {
        return $this->hasMany(Writer::class);
    }

    public function users()
    {
        return $this->hasMany(User::class, 'users_videos');
    }
}
