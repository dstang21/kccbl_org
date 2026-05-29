# Implementation Status

Last updated: 2026-05-28

## Summary
The repo has moved from a raw SQL dump to a working Laravel 12 application with a broad public route surface, a shared site shell, legacy-aware models, executable tests, a passing production front-end build, and a verified Hostinger deployment target for `kccbl.org`.

## Completed So Far

### Foundation
- Laravel 12 scaffolded into the repo root.
- Vite/Tailwind front-end pipeline configured and building.
- Project-local `postcss.config.js` added to isolate the app from parent Laragon PostCSS config bleed-through.
- Hostinger production constraints verified: `~/domains/kccbl.org/public_html` is the web root, the server has PHP/Composer/Git, the server does not have Node/npm, and GitHub SSH access to the repo works from the Hostinger shell.
- `public/build` is now treated as a deployment artifact that must stay committed for Hostinger deploys.

### Public App Slice
- Implemented homepage.
- Implemented team directory.
- Implemented current-season and historical team pages.
- Implemented printable team schedule.
- Implemented schedule and results pages.
- Implemented standings page.
- Implemented game box score page.
- Implemented player directory and player profile page.
- Implemented league roster page.
- Implemented statistics hub, hitting/pitching sections, leaders, player records, and team records.
- Implemented playoffs, staff, sponsors, parks, awards, all-stars, news, media, scouting videos, contact, terms, privacy.
- Implemented sitemap, robots, RSS, and diagnostics/support endpoints.

### Data Layer
- Added explicit models for the current public slice.
- Added season context resolver in `app/Support/SeasonContext.php`.
- Added route-key-aware models for `Club`, `Season`, and `BlogPost`.

### Validation
- `php artisan route:list` passes.
- `php artisan test` passes with 46 tests / 180 assertions.
- `npm run build` passes.

## Current Public Route Coverage
Registered now:
- `/`
- `/teams`
- `/teams/{club:slug}`
- `/teams/{club:slug}/{season}`
- `/teams/{club:slug}/schedule/print`
- `/schedule`
- `/results`
- `/game/{gameId}`
- `/standings`
- `/playoffs`
- `/players`
- `/players/{id}`
- `/league-roster`
- `/statistics`
- `/statistics/section/{type}`
- `/leaders`
- `/player-records`
- `/team-records`
- `/allstars`
- `/staff`
- `/sponsors`
- `/sponsorship-opportunities`
- `/sponsorship-packet`
- `/parks`
- `/about`
- `/awards`
- `/news`
- `/news/{slug}`
- `/media`
- `/scouting-videos`
- `/contact`
- `/terms`
- `/privacy`
- `/sitemap.xml`
- `/robots.txt`
- `/rss.xml`
- `/news/rss.xml`
- `/support/safari-diagnostics`
- `/support/minimal-status`
- `/diagnostics/status`
- `/diagnostics/browser-report`
- `/safari-diagnostics.html`

## Still Missing

### Auth / Profile
- `/profile`
- login / register / password reset UX
- authenticated account editing / deletion flow

### Player Access
- `/player/claims`
- `/player/dashboard`
- admin approval / rejection / revoke flow for player access

### Coach Surface
- all `/coach` routes
- team authorization middleware and policies
- roster/staff management tools
- suggestions flow UI

### Admin Surface
- all `/admin` routes
- dashboards, CRUD resources, season tools, headshots, social graphics, imports, access review, and playoff/statistics operations

## Recommended Next Slice
1. Install or scaffold auth/profile against the existing `users` table.
2. Add role-aware middleware and route groups.
3. Build player claims.
4. Build `/coach`.
5. Build `/admin`.

## Deployment Baseline
- Domain root: `~/domains/kccbl.org`
- Public web root: `~/domains/kccbl.org/public_html`
- Current public web root contents: Hostinger placeholder `default.php`
- Server toolchain confirmed: PHP 8.4, Composer 2.9, Git 2.47
- Server toolchain missing: Node, npm
- GitHub access from Hostinger confirmed for `git@github.com:dstang21/kccbl_org.git`
- Because the server cannot build Vite assets, production deployments must ship the locally built `public/build` directory.

## Working Rules For Future Agents
- Read `AGENTS.md` first.
- Read `docs/architecture.md` before changing data relationships.
- Update this file after any meaningful implementation slice.
- Do not remove the route parity tests unless stronger coverage replaces them.