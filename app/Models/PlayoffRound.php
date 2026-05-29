<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PlayoffRound extends Model
{
    use HasFactory;

    protected $table = 'playoff_rounds';

    protected $guarded = [];

    protected function casts(): array
    {
        return [
            'start_date' => 'date',
            'end_date' => 'date',
        ];
    }

    public function bracket(): BelongsTo
    {
        return $this->belongsTo(PlayoffBracket::class, 'playoff_bracket_id');
    }

    public function matchups(): HasMany
    {
        return $this->hasMany(PlayoffMatchup::class, 'playoff_round_id');
    }
}