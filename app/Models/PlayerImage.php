<?php

namespace App\Models;

use App\Models\Concerns\ResolvesLegacyMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PlayerImage extends Model
{
    use HasFactory;
    use ResolvesLegacyMedia;

    protected $table = 'player_images';

    protected $guarded = [];

    protected function casts(): array
    {
        return [
            'active' => 'boolean',
        ];
    }

    public function player(): BelongsTo
    {
        return $this->belongsTo(Player::class, 'player_id', 'player_id');
    }

    public function getImageUrlAttribute(): ?string
    {
        return $this->resolveMediaPath($this->image_name);
    }
}