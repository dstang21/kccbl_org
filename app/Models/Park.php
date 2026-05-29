<?php

namespace App\Models;

use App\Models\Concerns\ResolvesLegacyMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Park extends Model
{
    use HasFactory;
    use ResolvesLegacyMedia;

    protected $table = 'parks';

    protected $primaryKey = 'park_id';

    protected $guarded = [];

    public function fields(): HasMany
    {
        return $this->hasMany(ParkField::class, 'park_id', 'park_id');
    }

    public function getImageUrlAttribute(): ?string
    {
        return $this->resolveMediaPath($this->image);
    }
}