<?php

use App\Http\Controllers\Public\GameController;
use App\Http\Controllers\Public\HomeController;
use App\Http\Controllers\Public\PageController;
use App\Http\Controllers\Public\PlayerController;
use App\Http\Controllers\Public\ScheduleController;
use App\Http\Controllers\Public\SeoController;
use App\Http\Controllers\Public\StandingsController;
use App\Http\Controllers\Public\StatisticsController;
use App\Http\Controllers\Public\TeamController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::controller(TeamController::class)
    ->prefix('teams')
    ->name('teams.')
    ->group(function (): void {
        Route::get('/', 'index')->name('index');
        Route::get('{club:slug}/schedule/print', 'printSchedule')->name('schedule.print');
        Route::get('{club:slug}/{season}', 'showSeason')->name('season');
        Route::get('{club:slug}', 'showCurrent')->name('show');
    });

Route::controller(ScheduleController::class)->group(function (): void {
    Route::get('/schedule', 'index')->name('schedule.index');
    Route::get('/results', 'results')->name('results.index');
});

Route::get('/standings', [StandingsController::class, 'index'])->name('standings.index');

Route::get('/game/{gameId}', [GameController::class, 'show'])->name('game.show');

Route::controller(PlayerController::class)->group(function (): void {
    Route::get('/players', 'index')->name('players.index');
    Route::get('/players/{id}', 'show')->name('players.show');
    Route::get('/league-roster', 'leagueRoster')->name('league-roster.index');
});

Route::controller(StatisticsController::class)->group(function (): void {
    Route::get('/statistics', 'index')->name('statistics.index');
    Route::get('/statistics/section/{type}', 'section')->name('statistics.section');
    Route::get('/leaders', 'leaders')->name('leaders.index');
    Route::get('/player-records', 'playerRecords')->name('player-records.index');
    Route::get('/team-records', 'teamRecords')->name('team-records.index');
});

Route::controller(PageController::class)->group(function (): void {
    Route::get('/playoffs', 'playoffs')->name('playoffs.index');
    Route::get('/allstars', 'allstars')->name('allstars.index');
    Route::get('/staff', 'staff')->name('staff.index');
    Route::get('/sponsors', 'sponsors')->name('sponsors.index');
    Route::get('/sponsorship-opportunities', 'sponsorshipOpportunities')->name('sponsorship-opportunities.show');
    Route::get('/sponsorship-packet', 'sponsorshipPacket')->name('sponsorship-packet.show');
    Route::get('/parks', 'parks')->name('parks.index');
    Route::get('/about', 'about')->name('about.show');
    Route::get('/awards', 'awards')->name('awards.index');
    Route::get('/news', 'newsIndex')->name('news.index');
    Route::get('/news/{slug}', 'newsShow')->name('news.show');
    Route::get('/media', 'media')->name('media.index');
    Route::get('/scouting-videos', 'scoutingVideos')->name('scouting-videos.index');
    Route::get('/contact', 'contact')->name('contact.show');
    Route::post('/contact', 'submitContact')->name('contact.store');
    Route::get('/terms', 'terms')->name('terms.show');
    Route::get('/privacy', 'privacy')->name('privacy.show');
    Route::get('/support/safari-diagnostics', 'safariDiagnostics')->name('support.safari-diagnostics');
    Route::get('/safari-diagnostics.html', 'safariDiagnostics')->name('support.safari-diagnostics.legacy');
});

Route::controller(SeoController::class)->group(function (): void {
    Route::get('/sitemap.xml', 'sitemap')->name('sitemap');
    Route::get('/robots.txt', 'robots')->name('robots');
    Route::get('/rss.xml', 'feed')->name('rss');
    Route::get('/news/rss.xml', 'feed')->name('news.rss');
    Route::get('/support/minimal-status', 'minimalStatus')->name('support.minimal-status');
    Route::get('/diagnostics/status', 'diagnosticsStatus')->name('diagnostics.status');
    Route::match(['get', 'post'], '/diagnostics/browser-report', 'browserReport')->name('diagnostics.browser-report');
});
