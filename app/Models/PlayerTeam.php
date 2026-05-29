<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PlayerTeam extends Model
{
    use HasFactory;

    protected $table = 'player_teams';

    protected $primaryKey = 'player_team_id';

    protected $guarded = [];

    public function player(): BelongsTo
    {
        return $this->belongsTo(Player::class, 'player_id', 'player_id');
    }

    public function club(): BelongsTo
    {
        return $this->belongsTo(Club::class, 'club_id');
    }

    public function seasonModel(): BelongsTo
    {
        return $this->belongsTo(Season::class, 'season', 'year');
    }
}