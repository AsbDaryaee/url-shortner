<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Url extends Model
{
    protected $hidden = ['id'];

    protected $fillable = [
        'user_id',
        'name',
        'description',
        'url',
        'uuid',
        'views'
    ];

    protected static function booted(): void
    {
        static::creating(function ($url) {
            $url->uuid = self::generateShortCode();
        });
    }

    public static function generateShortCode(): string
    {
        do {
            $code = Str::random(7);
        } while (self::where('uuid', $code)->exists());

        return $code;
    }

//    bind by UUID automatically
    public function getRouteKeyName(): string
    {
        return 'uuid';
    }

//    Relations
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

//    Helpers
    public function addView(): void
    {
        $this->increment('views');
    }

}
