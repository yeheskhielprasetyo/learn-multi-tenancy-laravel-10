<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Model
{
    use HasFactory;

    public static function booted()
    {
        static::created(function ($user) {
            $userTenant = \App\Models\Tenant::create(['id' => $user->domain]);
            $userTenant->domains()->create(['domain' => $user->domain . '.' . env('APP_CENTRAL_DOMAIN')]);
        });
    }
}
