<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeedBack extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'last_name',
        'email',
        'feedback',
        'feedback_file',
        'type',
        'issue',
        'phone'
    ];
}
