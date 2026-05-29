<?php

namespace App\Models;

use App\Models\Concerns\ResolvesLegacyMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Club extends Model
{
    use HasFactory;
    use ResolvesLegacyMedia;

    protected $table = 'clubs';

    protected $guarded = [];

    protected function casts(): array
    {
        return [
            'active' => 'boolean',
        ];
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function seasonRecords(): HasMany
    {
        return $this->hasMany(SeasonTeam::class, 'club_id');
    }

    public function rosterMemberships(): HasMany
    {
        return $this->hasMany(PlayerTeam::class, 'club_id');
    }

    public function coaches(): HasMany
    {
        return $this->hasMany(TeamCoach::class, 'club_id');
    }

    public function homeGames(): HasMany
    {
        return $this->hasMany(Game::class, 'club_1_id');
    }

    public function awayGames(): HasMany
    {
        return $this->hasMany(Game::class, 'club_2_id');
    }

    public function getLogoUrlAttribute(): ?string
    {
        return $this->resolveMediaPath($this->logo);
    }

    public function getCoverPhotoUrlAttribute(): ?string
    {
        return $this->resolveMediaPath($this->cover_photo);
    }
}