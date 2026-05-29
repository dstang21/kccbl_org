<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class GameInning extends Model
{
    use HasFactory;

    protected $table = 'game_innings';

    protected $primaryKey = 'inning_id';

    protected $guarded = [];
    public $incrementing = true;

    public function game(): BelongsTo
    {
        return $this->belongsTo(Game::class, 'game_id', 'game_id');
    }
}