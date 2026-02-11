<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WelcomeIntro extends Model
{
    protected $fillable = [
        'title',
        'body',
    ];

    public static function instance(): ?self
    {
        return static::query()->first();
    }
}
