<?php

namespace App\Models;

use App\Models\Concerns\ResolvesLegacyMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AwardedPlayer extends Model
{
    use HasFactory;
    use ResolvesLegacyMedia;

    protected $table = 'awarded_players';

    protected $primaryKey = 'awarded_players_id';

    protected $guarded = [];

    public $timestamps = false;

    protected function casts(): array
    {
        return [
            'date_awarded' => 'date',
        ];
    }

    public function award(): BelongsTo
    {
        return $this->belongsTo(Award::class, 'award_id', 'award_id');
    }

    public function player(): BelongsTo
    {
        return $this->belongsTo(Player::class, 'player_id', 'player_id');
    }

    public function getPhotoUrlAttribute(): ?string
    {
        return $this->resolveMediaPath($this->photo);
    }
}