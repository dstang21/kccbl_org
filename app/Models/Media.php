<?php

namespace App\Models;

use App\Models\Concerns\ResolvesLegacyMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    use HasFactory;
    use ResolvesLegacyMedia;

    protected $table = 'media';

    protected $primaryKey = 'media_id';

    protected $guarded = [];

    protected function casts(): array
    {
        return [
            'use_as_cover_photo' => 'boolean',
            'uploaded_at' => 'datetime',
        ];
    }

    public function getMediaUrlAttribute(): ?string
    {
        return $this->resolveMediaPath($this->media_link);
    }
}