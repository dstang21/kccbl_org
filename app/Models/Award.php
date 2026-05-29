<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Award extends Model
{
    use HasFactory;

    protected $table = 'awards';

    protected $primaryKey = 'award_id';

    protected $guarded = [];

    public $timestamps = false;

    public function awardedPlayers(): HasMany
    {
        return $this->hasMany(AwardedPlayer::class, 'award_id', 'award_id');
    }
}