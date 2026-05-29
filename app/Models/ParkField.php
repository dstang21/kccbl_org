<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ParkField extends Model
{
    use HasFactory;

    protected $table = 'park_fields';

    protected $primaryKey = 'field_id';

    protected $guarded = [];

    protected function casts(): array
    {
        return [
            'bleachers' => 'boolean',
        ];
    }

    public function park(): BelongsTo
    {
        return $this->belongsTo(Park::class, 'park_id', 'park_id');
    }

    public function games(): HasMany
    {
        return $this->hasMany(Game::class, 'park_field_id', 'field_id');
    }
}