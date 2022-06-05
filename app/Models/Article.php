<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class Article extends Model
{
    use HasApiTokens, Notifiable;

    protected $fillable = [
        'title',
        'content',
        'image',
        'user_id',
        'category_id'
    ];
}
