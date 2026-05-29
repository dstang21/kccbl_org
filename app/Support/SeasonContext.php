<?php

namespace App\Support;

use App\Models\Season;

class SeasonContext
{
    public function current(): ?Season
    {
        return Season::query()
            ->where('active', true)
            ->orderByDesc('year')
            ->first()
            ?? Season::query()->orderByDesc('year')->first();
    }

    public function resolve(?Season $season = null): ?Season
    {
        return $season ?? $this->current();
    }
}