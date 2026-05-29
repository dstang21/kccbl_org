<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SeasonStat extends Model
{
    use HasFactory;

    protected $table = 'season_stats';

    protected $primaryKey = 'season_stat_id';

    protected $guarded = [];

    public function player(): BelongsTo
    {
        return $this->belongsTo(Player::class, 'player_id', 'player_id');
    }

    public function getBattingAverageAttribute(): string
    {
        if ($this->AB < 1) {
            return '.000';
        }

        return sprintf('%.3f', $this->H / $this->AB);
    }

    public function getEarnedRunAverageAttribute(): string
    {
        if ((float) $this->IP <= 0.0) {
            return '0.00';
        }

        return sprintf('%.2f', ($this->ER * 9) / (float) $this->IP);
    }

    public function getWhipAttribute(): string
    {
        if ((float) $this->IP <= 0.0) {
            return '0.00';
        }

        return sprintf('%.2f', ($this->BB_Pitched + $this->HA) / (float) $this->IP);
    }
}