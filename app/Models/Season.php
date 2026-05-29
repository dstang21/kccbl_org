<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Season extends Model
{
    use HasFactory;

    protected $table = 'seasons';

    protected $guarded = [];

    protected function casts(): array
    {
        return [
            'active' => 'boolean',
            'start_date' => 'date',
            'end_date' => 'date',
        ];
    }

    public function getRouteKeyName(): string
    {
        return 'year';
    }

    public function teams(): HasMany
    {
        return $this->hasMany(SeasonTeam::class, 'season', 'year');
    }

    public function games(): HasMany
    {
        return $this->hasMany(Game::class, 'season', 'year');
    }
}