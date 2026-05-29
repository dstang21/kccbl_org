<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ScoutingVideo extends Model
{
    use HasFactory;

    protected $table = 'scouting_videos';

    protected $guarded = [];

    protected function casts(): array
    {
        return [
            'featured' => 'boolean',
            'post_date' => 'date',
        ];
    }

    public function player(): BelongsTo
    {
        return $this->belongsTo(Player::class, 'player_id', 'player_id');
    }
}