<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PlayoffBracket extends Model
{
    use HasFactory;

    protected $table = 'playoff_brackets';

    protected $guarded = [];

    protected function casts(): array
    {
        return [
            'active' => 'boolean',
        ];
    }

    public function rounds(): HasMany
    {
        return $this->hasMany(PlayoffRound::class, 'playoff_bracket_id');
    }

    public function seeds(): HasMany
    {
        return $this->hasMany(PlayoffSeed::class, 'playoff_bracket_id');
    }
}