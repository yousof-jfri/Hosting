<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Video;

class UserVideo extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'video_id',
    ];

    protected $table = 'users_videos';

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function video()
    {
        return $this->belongsTo(Video::class);
    }
}
