# KCCBL Laravel Rebuild

This repo rebuilds the KCCBL baseball league site as a Laravel 12 application while preserving the legacy database schema, public URL structure, season-aware behavior, and sports-site identity.

The goal is not just parity. The goal is to turn the existing product into a best-in-class league website without losing what makes it recognizably KCCBL.

## Canonical Inputs
- Legacy schema dump: `u596677651_kccbl_remake (3).sql`
- App framework: Laravel 12 + Blade + Vite + Tailwind CSS v4

## Documentation Index
- `AGENTS.md` — repo-level working rules, priorities, and handoff guide for future agents
- `.github/copilot-instructions.md` — concise repo-specific Copilot guidance
- `docs/architecture.md` — current architecture and model/controller/view map
- `docs/implementation-status.md` — what is implemented, what is missing, and what to do next

## Current Status
Implemented so far:
- Shared public site shell and styling foundation
- Broad public route coverage
- Core legacy-aware models for the public slice
- Public pages for teams, schedules, standings, players, stats, playoffs, news, media, sponsors, parks, awards, contact, and support endpoints
- Route parity tests and route-key tests

Still pending:
- Auth/profile
- Player claims
- Coach area
- Admin area

## Local Setup
1. Install PHP dependencies: `composer install`
2. Install front-end dependencies: `npm install`
3. Configure `.env` for the legacy MariaDB database
4. Import the schema from `u596677651_kccbl_remake (3).sql`
5. Generate the app key if needed: `php artisan key:generate`

Important:
- Do not run a migration strategy that tries to recreate the legacy schema in a new shape.
- Adapt Laravel to the existing tables through model configuration.

## Validation Commands
- `php artisan route:list`
- `php artisan test`
- `npm run build`

## Environment Note
Keep the repo-local `postcss.config.js` file in place. It prevents Vite from inheriting a parent Laragon PostCSS config outside this app.

## Hostinger Deployment Note
- `kccbl.org` is hosted from `~/domains/kccbl.org/public_html`.
- The Hostinger shell currently has PHP, Composer, and Git, but no Node or npm.
- Build front-end assets locally with `npm run build` and keep `public/build` committed so production deploys can run without a server-side Node toolchain.
