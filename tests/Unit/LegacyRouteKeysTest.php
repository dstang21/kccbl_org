<?php

namespace Tests\Unit;

use App\Models\BlogPost;
use App\Models\Club;
use App\Models\Game;
use App\Models\Player;
use App\Models\Season;
use App\Models\SeasonStat;
use PHPUnit\Framework\TestCase;

class LegacyRouteKeysTest extends TestCase
{
    public function test_slug_and_primary_key_configuration_matches_the_legacy_schema(): void
    {
        $this->assertSame('slug', (new Club())->getRouteKeyName());
        $this->assertSame('year', (new Season())->getRouteKeyName());
        $this->assertSame('slug', (new BlogPost())->getRouteKeyName());
        $this->assertSame('player_id', (new Player())->getKeyName());
        $this->assertSame('game_id', (new Game())->getKeyName());
        $this->assertSame('season_stat_id', (new SeasonStat())->getKeyName());
    }
}