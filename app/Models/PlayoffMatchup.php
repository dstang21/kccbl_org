<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PlayoffMatchup extends Model
{
    use HasFactory;

    protected $table = 'playoff_matchups';

    protected $guarded = [];

    public function round(): BelongsTo
    {
        return $this->belongsTo(PlayoffRound::class, 'playoff_round_id');
    }

    public function teamOne(): BelongsTo
    {
        return $this->belongsTo(Club::class, 'team1_id');
    }

    public function teamTwo(): BelongsTo
    {
        return $this->belongsTo(Club::class, 'team2_id');
    }

    public function winner(): BelongsTo
    {
        return $this->belongsTo(Club::class, 'winner_id');
    }
}