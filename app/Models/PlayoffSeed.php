<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PlayoffSeed extends Model
{
    use HasFactory;

    protected $table = 'playoff_seeds';

    protected $guarded = [];

    public function bracket(): BelongsTo
    {
        return $this->belongsTo(PlayoffBracket::class, 'playoff_bracket_id');
    }

    public function club(): BelongsTo
    {
        return $this->belongsTo(Club::class, 'club_id');
    }
}