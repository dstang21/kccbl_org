<?php

namespace App\Models;

use App\Models\Concerns\ResolvesLegacyMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sponsor extends Model
{
    use HasFactory;
    use ResolvesLegacyMedia;

    protected $table = 'sponsors';

    protected $primaryKey = 'sponsor_id';

    protected $guarded = [];

    public function getLogoUrlAttribute(): ?string
    {
        return $this->resolveMediaPath($this->logo);
    }
}