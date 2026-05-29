<?php

namespace App\Models;

use App\Models\Concerns\ResolvesLegacyMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogPost extends Model
{
    use HasFactory;
    use ResolvesLegacyMedia;

    protected $table = 'blog_posts';

    protected $primaryKey = 'post_id';

    protected $guarded = [];

    protected function casts(): array
    {
        return [
            'pinned' => 'boolean',
            'skip_content' => 'boolean',
        ];
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function getImageUrlAttribute(): ?string
    {
        return $this->resolveMediaPath($this->image ?: $this->share_image);
    }
}