<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Game extends Model
{
    use HasFactory;

    protected $table = 'games';

    protected $primaryKey = 'game_id';

    protected $guarded = [];

    protected function casts(): array
    {
        return [
            'game_date' => 'datetime',
            'team_1_home' => 'boolean',
            'team_2_home' => 'boolean',
            'team_1_win' => 'boolean',
            'team_2_win' => 'boolean',
            'tie' => 'boolean',
        ];
    }

    public function clubOne(): BelongsTo
    {
        return $this->belongsTo(Club::class, 'club_1_id');
    }

    public function clubTwo(): BelongsTo
    {
        return $this->belongsTo(Club::class, 'club_2_id');
    }

    public function parkField(): BelongsTo
    {
        return $this->belongsTo(ParkField::class, 'park_field_id', 'field_id');
    }

    public function innings(): HasMany
    {
        return $this->hasMany(GameInning::class, 'game_id', 'game_id');
    }

    public function scopeForSeason(Builder $query, Season|int|null $season): Builder
    {
        $year = $season instanceof Season ? $season->year : $season;

        if (! $year) {
            return $query;
        }

        return $query->where('season', $year);
    }

    public function scopeCompleted(Builder $query): Builder
    {
        return $query->where(function (Builder $builder): void {
            $builder
                ->whereNotNull('winner')
                ->orWhere('tie', true)
                ->orWhere('team_1_score', '>', 0)
                ->orWhere('team_2_score', '>', 0);
        });
    }

    public function scopeScheduled(Builder $query): Builder
    {
        return $query->where(function (Builder $builder): void {
            $builder
                ->whereNull('winner')
                ->where('tie', false)
                ->where('team_1_score', 0)
                ->where('team_2_score', 0);
        });
    }

    public function getCompletedAttribute(): bool
    {
        return $this->winner !== null
            || $this->tie
            || $this->team_1_score > 0
            || $this->team_2_score > 0;
    }

    public function getStatusLabelAttribute(): string
    {
        return $this->completed ? ($this->tie ? 'Final/Tie' : 'Final') : 'Scheduled';
    }

    public function getMatchupLabelAttribute(): string
    {
        $clubOne = $this->clubOne?->short_name ?: $this->clubOne?->name ?: 'TBD';
        $clubTwo = $this->clubTwo?->short_name ?: $this->clubTwo?->name ?: 'TBD';

        return $clubOne.' vs '.$clubTwo;
    }
}