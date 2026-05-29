<?php

namespace App\Models\Concerns;

trait ResolvesLegacyMedia
{
    protected function resolveMediaPath(?string $path): ?string
    {
        if (! $path) {
            return null;
        }

        if (
            str_starts_with($path, 'http://')
            || str_starts_with($path, 'https://')
            || str_starts_with($path, '/')
        ) {
            return $path;
        }

        return asset(ltrim($path, '/'));
    }
}