# Architecture

## Purpose
This repo is a Laravel 12 rebuild of the KCCBL baseball league website using the legacy MariaDB schema directly.

The guiding principle is compatibility first, modernization second.

## Core Domain Decisions

### Team Identity Model
- `clubs` is the public franchise identity.
- `season_teams` is the season-specific team/standings record.
- `teams` is a legacy compatibility table still referenced by older data paths such as `games.team_1_id`, `games.team_2_id`, and `player_teams.team_id`.

### Season Model
- `seasons.year` is the route key.
- `seasons.active` determines the default season.
- `app/Support/SeasonContext.php` centralizes active-season lookup and latest-year fallback.

### Route Key Model
- `Club` binds by `slug`.
- `Season` binds by `year`.
- `BlogPost` binds by `slug`.
- `Player` uses `player_id`.
- `Game` uses `game_id`.

## Current Public Controller Map
- `Public/HomeController` — homepage, featured season context, standings snapshot, upcoming games, recent results, news, sponsors.
- `Public/TeamController` — team directory, current-season team page, historical season page, printable team schedule.
- `Public/ScheduleController` — schedule and results views.
- `Public/StandingsController` — standings grouped by division.
- `Public/GameController` — box score page with line score, batting, and pitching tables.
- `Public/PlayerController` — player directory, player profiles, league roster.
- `Public/StatisticsController` — stats hub, hitting/pitching sections, leaders, player records, team records.
- `Public/PageController` — playoffs, staff, sponsors, parks, awards, all-stars, news, media, scouting videos, contact, static/legal/support pages.
- `Public/SeoController` — sitemap, robots, feeds, diagnostics, and support status endpoints.

## Current Model Coverage

### Core Models
- `Club`
- `Season`
- `SeasonTeam`
- `Game`
- `GameInning`
- `GameStat`
- `Player`
- `PlayerTeam`
- `PlayerImage`
- `SeasonStat`
- `TeamStatRegular`

### Content / Support Models
- `BlogPost`
- `Sponsor`
- `Media`
- `ScoutingVideo`
- `ContactInquiry`

### People / Organization Models
- `Staff`
- `TeamCoach`

### Recognition / Playoff Models
- `Award`
- `AwardedPlayer`
- `PlayoffBracket`
- `PlayoffRound`
- `PlayoffMatchup`
- `PlayoffSeed`

### Venue Models
- `Park`
- `ParkField`

## View Structure
- `resources/views/layouts/app.blade.php` — shared shell.
- `resources/views/public/home/` — homepage.
- `resources/views/public/teams/` — team directory, team profile, print schedule.
- `resources/views/public/schedule/` — schedule and results.
- `resources/views/public/game/` — box score.
- `resources/views/public/players/` — player directory and profile.
- `resources/views/public/roster/` — league roster.
- `resources/views/public/stats/` — stats hub and records.
- `resources/views/public/playoffs/` — playoff page.
- `resources/views/public/content/` — staff, sponsors, parks, awards, contact, static/legal/support pages.
- `resources/views/public/news/` — news index and article detail.
- `resources/views/public/media/` — media gallery.
- `resources/views/public/videos/` — scouting videos.

## Validation Surface
- `tests/Feature/PublicRouteParityTest.php` verifies that the implemented public route inventory remains registered.
- `tests/Unit/LegacyRouteKeysTest.php` verifies that key route-binding and primary-key assumptions remain aligned with the legacy schema.

## Current Gaps
- Auth/profile is not implemented yet.
- Player claim flow is not implemented yet.
- Coach routes and authorization are not implemented yet.
- Admin routes and CRUD surfaces are not implemented yet.
- Some advanced schema areas still need deeper mapping, including blog tags, postseason totals, team post stats, season team user access, player claims, and coach/admin workflow tables.
- Public pages currently emphasize route parity and core data rendering, but several pages still need richer filters, metadata, and production polish.

## Known Constraints
- Do not run a migration strategy that attempts to recreate or rename the legacy tables.
- The project-local `postcss.config.js` must remain present so Vite does not inherit a parent Laragon PostCSS config.
- The current tests intentionally avoid depending on a locally imported legacy schema; route and configuration tests are the current safe baseline.
- Hostinger shared hosting for `kccbl.org` serves from `~/domains/kccbl.org/public_html`, with the Laravel app expected to live outside the web root.
- The current Hostinger shell has PHP, Composer, and Git, but no Node or npm.
- Production deploys therefore rely on prebuilt Vite assets being present in `public/build`.