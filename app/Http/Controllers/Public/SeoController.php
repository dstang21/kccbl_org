<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use App\Models\Club;
use App\Support\SeasonContext;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SeoController extends Controller
{
    public function __construct(private readonly SeasonContext $seasonContext)
    {
    }

    public function sitemap(): Response
    {
        $urls = collect([
            url('/'),
            url('/teams'),
            url('/schedule'),
            url('/results'),
            url('/standings'),
            url('/players'),
            url('/league-roster'),
            url('/statistics'),
            url('/leaders'),
            url('/playoffs'),
            url('/staff'),
            url('/sponsors'),
            url('/parks'),
            url('/awards'),
            url('/news'),
            url('/media'),
            url('/scouting-videos'),
            url('/contact'),
            url('/about'),
            url('/terms'),
            url('/privacy'),
        ])
            ->merge(Club::query()->whereNotNull('slug')->pluck('slug')->map(fn (string $slug) => url('/teams/'.$slug)))
            ->merge(BlogPost::query()->whereNotNull('slug')->pluck('slug')->map(fn (string $slug) => url('/news/'.$slug)));

        $xml = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
        $xml .= "<urlset xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\">\n";

        foreach ($urls->unique() as $url) {
            $xml .= "  <url><loc>".e($url)."</loc></url>\n";
        }

        $xml .= "</urlset>";

        return response($xml, 200, ['Content-Type' => 'application/xml']);
    }

    public function robots(): Response
    {
        $body = implode("\n", [
            'User-agent: *',
            'Allow: /',
            'Sitemap: '.url('/sitemap.xml'),
        ]);

        return response($body, 200, ['Content-Type' => 'text/plain']);
    }

    public function feed(): Response
    {
        $posts = BlogPost::query()->orderByDesc('created_at')->limit(20)->get();

        $xml = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
        $xml .= "<rss version=\"2.0\"><channel>\n";
        $xml .= '<title>KCCBL News</title>';
        $xml .= '<link>'.e(url('/news')).'</link>';
        $xml .= '<description>KCCBL news and league updates.</description>';

        foreach ($posts as $post) {
            $xml .= '<item>';
            $xml .= '<title>'.e($post->title).'</title>';
            $xml .= '<link>'.e(url('/news/'.$post->slug)).'</link>';
            $xml .= '<description>'.e(strip_tags($post->sub_header ?: $post->content)).'</description>';
            $xml .= '</item>';
        }

        $xml .= '</channel></rss>';

        return response($xml, 200, ['Content-Type' => 'application/rss+xml']);
    }

    public function minimalStatus(): Response
    {
        return response()->json([
            'app' => config('app.name', 'KCCBL'),
            'season' => $this->seasonContext->current()?->year,
            'status' => 'ok',
        ]);
    }

    public function diagnosticsStatus(): Response
    {
        return response()->json([
            'framework' => app()->version(),
            'php' => PHP_VERSION,
            'season' => $this->seasonContext->current()?->year,
            'status' => 'ok',
        ]);
    }

    public function browserReport(Request $request): Response
    {
        return response()->json([
            'received' => true,
            'payload' => $request->all(),
            'status' => 'ok',
        ]);
    }
}