# KCCBL Agent Guide

## Mission
Rebuild the KCCBL website into a production-grade Laravel application that feels unmistakably like a serious baseball league site, preserves the existing database and URL structure, and keeps improving until it is among the best baseball league websites on the internet.

This is not a generic Laravel app and not a redesign exercise. The bar is high: data-rich, fast, season-aware, visually strong, and faithful to the current product identity.

## Canonical Sources
1. The database dump at `u596677651_kccbl_remake (3).sql` is the canonical source of truth for entities, keys, and relationships.
2. Public URL parity from the original rebuild brief is mandatory unless the schema makes an exact match impossible.
3. The current implementation status lives in `docs/implementation-status.md`.
4. The current architecture and model map live in `docs/architecture.md`.

## Non-Negotiables
- Do not redesign the database.
- Do not rename legacy tables or columns to fit Laravel conventions; adapt through model configuration.
- Treat `clubs` as the public franchise/team identity.
- Treat `season_teams` as the primary season-scoped standings/team layer.
- Treat `teams` as a legacy compatibility layer still referenced by older schedule/roster records.
- Treat `seasons.active` as the default season resolver, with latest-year fallback only when an active row is missing.
- Preserve slug and ID behavior exactly where the schema implies it:
  - `clubs.slug`
  - `blog_posts.slug`
  - `seasons.year`
  - `players.player_id`
  - `games.game_id`
- Keep the app server-rendered with Laravel Blade, controllers, models, middleware, and policies.

## Quality Bar
Future work should aim beyond parity:
- Sports-site density over sparse SaaS layouts.
- Strong typography, club branding, standings, stats, and schedule presentation.
- Excellent mobile behavior without flattening the desktop information density.
- Fast navigation between teams, standings, results, players, stats, and news.
- Accessible markup and predictable keyboard navigation.
- Real public utility: no dead-end shells when live data can be shown.

## Current State
Implemented now:
- Laravel 12 scaffold in the repo root.
- Shared Blade shell and sports-site styling foundation.
- Public routes for homepage, teams, team season pages, printable team schedule, schedule, results, standings, players, player profiles, league roster, statistics, leaders, records, box score, playoffs, staff, sponsors, parks, awards, all-stars, news, media, scouting videos, contact, terms, privacy, and SEO/support endpoints.
- Schema-aware Eloquent models for the first public slice.
- Route parity tests and legacy route-key tests.
- Passing `php artisan test` and `npm run build`.

Not started yet:
- Auth/profile implementation.
- Player claim workflow UI.
- Coach area.
- Admin area.
- Deeper public refinements like richer box score attribution, tag relationships, advanced records, and season-specific SEO/meta tuning.

## Key Files
- `routes/web.php` — current public route map.
- `app/Support/SeasonContext.php` — active season resolution.
- `app/Http/Controllers/Public/` — current public controller surface.
- `app/Models/` — legacy-aware model mapping.
- `resources/views/layouts/app.blade.php` — shared site shell.
- `resources/views/public/` — public page views.
- `tests/Feature/PublicRouteParityTest.php` — route inventory coverage.
- `tests/Unit/LegacyRouteKeysTest.php` — route key / primary key coverage.

## How To Work In This Repo
1. Read `docs/implementation-status.md` before starting a new slice.
2. Read `docs/architecture.md` before changing models, route binding, or season behavior.
3. Pick one coherent slice at a time.
4. Prefer implementing real data-backed pages over placeholder pages when the schema supports it.
5. Keep route parity intact while evolving the internals.
6. After every meaningful change, update the docs so the next agent does not have to reverse-engineer the repo state.

## Validation Checklist
Run the narrowest useful checks first, then the broader ones:
- `php artisan route:list`
- `php artisan test`
- `npm run build`

## Known Environment Note
Add and keep the project-local `postcss.config.js`. Without it, Vite can inherit a parent Laragon PostCSS config from `c:\laragon\www\postcss.config.js` and fail the build.

## Next Best Slices
1. Implement Laravel auth and `/profile` cleanly against the existing `users` table.
2. Build player claim submission/review flow on top of `player_claim_requests` and `users.claimed_player_id`.
3. Add coach middleware, team authorization, and the `/coach` namespace.
4. Build admin resources and season management tools under `/admin`.
5. Deepen public pages with richer game stats, playoff rendering, tag relationships, sponsor/media polish, and SEO metadata.

## Documentation Rule
If you change route coverage, architecture, workflow status, model assumptions, or validation commands, update at least:
- `docs/implementation-status.md`
- `docs/architecture.md`

Update `README.md` too when the change affects onboarding, setup, or the public app surface.