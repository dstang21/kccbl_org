<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SeasonTeam extends Model
{
    use HasFactory;

    protected $table = 'season_teams';

    protected $guarded = [];

    public function club(): BelongsTo
    {
        return $this->belongsTo(Club::class, 'club_id');
    }

    public function seasonModel(): BelongsTo
    {
        return $this->belongsTo(Season::class, 'season', 'year');
    }

    public function getRecordAttribute(): string
    {
        return sprintf('%d-%d-%d', $this->wins, $this->losses, $this->ties);
    }

    public function getWinPercentageAttribute(): float
    {
        $gamesPlayed = $this->wins + $this->losses + $this->ties;

        if ($gamesPlayed === 0) {
            return 0.0;
        }

        return round(($this->wins + ($this->ties * 0.5)) / $gamesPlayed, 3);
    }
}