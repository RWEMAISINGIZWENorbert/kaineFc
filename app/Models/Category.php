<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    protected $fillable = [
        'name',
        'type',
        'description',
    ];

    public function players(): HasMany
    {
        return $this->hasMany(Player::class);
    }

    public function staff(): HasMany
    {
        return $this->hasMany(Staff::class);
    }
} 