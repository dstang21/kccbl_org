<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Player extends Model
{
    use HasFactory;

    protected $table = 'players';

    protected $primaryKey = 'player_id';

    protected $guarded = [];

    public function memberships(): HasMany
    {
        return $this->hasMany(PlayerTeam::class, 'player_id', 'player_id');
    }

    public function images(): HasMany
    {
        return $this->hasMany(PlayerImage::class, 'player_id', 'player_id');
    }

    public function activeImage(): HasOne
    {
        return $this->hasOne(PlayerImage::class, 'player_id', 'player_id')
            ->where('active', true)
            ->latestOfMany();
    }

    public function getFullNameAttribute(): string
    {
        return trim($this->first_name.' '.$this->last_name);
    }
}