<?php

namespace Tests\Feature;

use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

class PublicRouteParityTest extends TestCase
{
    public static function publicRouteProvider(): array
    {
        return [
            ['home', '/', ['GET', 'HEAD']],
            ['teams.index', 'teams', ['GET', 'HEAD']],
            ['teams.show', 'teams/{club}', ['GET', 'HEAD']],
            ['teams.season', 'teams/{club}/{season}', ['GET', 'HEAD']],
            ['teams.schedule.print', 'teams/{club}/schedule/print', ['GET', 'HEAD']],
            ['schedule.index', 'schedule', ['GET', 'HEAD']],
            ['results.index', 'results', ['GET', 'HEAD']],
            ['game.show', 'game/{gameId}', ['GET', 'HEAD']],
            ['standings.index', 'standings', ['GET', 'HEAD']],
            ['playoffs.index', 'playoffs', ['GET', 'HEAD']],
            ['players.index', 'players', ['GET', 'HEAD']],
            ['players.show', 'players/{id}', ['GET', 'HEAD']],
            ['league-roster.index', 'league-roster', ['GET', 'HEAD']],
            ['statistics.index', 'statistics', ['GET', 'HEAD']],
            ['statistics.section', 'statistics/section/{type}', ['GET', 'HEAD']],
            ['leaders.index', 'leaders', ['GET', 'HEAD']],
            ['player-records.index', 'player-records', ['GET', 'HEAD']],
            ['team-records.index', 'team-records', ['GET', 'HEAD']],
            ['allstars.index', 'allstars', ['GET', 'HEAD']],
            ['staff.index', 'staff', ['GET', 'HEAD']],
            ['sponsors.index', 'sponsors', ['GET', 'HEAD']],
            ['sponsorship-opportunities.show', 'sponsorship-opportunities', ['GET', 'HEAD']],
            ['sponsorship-packet.show', 'sponsorship-packet', ['GET', 'HEAD']],
            ['parks.index', 'parks', ['GET', 'HEAD']],
            ['about.show', 'about', ['GET', 'HEAD']],
            ['awards.index', 'awards', ['GET', 'HEAD']],
            ['news.index', 'news', ['GET', 'HEAD']],
            ['news.show', 'news/{slug}', ['GET', 'HEAD']],
            ['media.index', 'media', ['GET', 'HEAD']],
            ['scouting-videos.index', 'scouting-videos', ['GET', 'HEAD']],
            ['contact.show', 'contact', ['GET', 'HEAD']],
            ['contact.store', 'contact', ['POST']],
            ['terms.show', 'terms', ['GET', 'HEAD']],
            ['privacy.show', 'privacy', ['GET', 'HEAD']],
            ['sitemap', 'sitemap.xml', ['GET', 'HEAD']],
            ['robots', 'robots.txt', ['GET', 'HEAD']],
            ['rss', 'rss.xml', ['GET', 'HEAD']],
            ['news.rss', 'news/rss.xml', ['GET', 'HEAD']],
            ['support.safari-diagnostics', 'support/safari-diagnostics', ['GET', 'HEAD']],
            ['support.safari-diagnostics.legacy', 'safari-diagnostics.html', ['GET', 'HEAD']],
            ['support.minimal-status', 'support/minimal-status', ['GET', 'HEAD']],
            ['diagnostics.status', 'diagnostics/status', ['GET', 'HEAD']],
            ['diagnostics.browser-report', 'diagnostics/browser-report', ['GET', 'HEAD', 'POST']],
        ];
    }

    #[DataProvider('publicRouteProvider')]
    public function test_public_routes_are_registered(string $name, string $uri, array $methods): void
    {
        $route = app('router')->getRoutes()->getByName($name);

        $this->assertNotNull($route, 'Expected route ['.$name.'] to be registered.');
        $this->assertSame($uri, $route->uri());

        foreach ($methods as $method) {
            $this->assertContains($method, $route->methods(), 'Expected route ['.$name.'] to allow method ['.$method.'].');
        }
    }
}