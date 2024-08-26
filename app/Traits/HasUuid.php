<?php

namespace App\Traits;

use Illuminate\Support\Str;

trait HasUuid
{
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if (empty($model->uuid)) {
                $model->uuid = Str::uuid()->toString();
            }
        });
    }
    public static function findByUuid($uuid)
    {
        return self::query()->where('uuid', $uuid)->first();
    }
}
