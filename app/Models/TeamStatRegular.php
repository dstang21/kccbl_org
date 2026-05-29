<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TeamStatRegular extends Model
{
    use HasFactory;

    protected $table = 'team_stats_regular';

    protected $primaryKey = 'team_stat_regular_id';

    protected $guarded = [];

    public function club(): BelongsTo
    {
        return $this->belongsTo(Club::class, 'club_id');
    }

    public function getWinningPercentageAttribute(): string
    {
        $gamesPlayed = $this->wins + $this->losses;

        if ($gamesPlayed === 0) {
            return '.000';
        }

        return sprintf('%.3f', $this->wins / $gamesPlayed);
    }
}