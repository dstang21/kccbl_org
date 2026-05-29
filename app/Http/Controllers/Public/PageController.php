<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Award;
use App\Models\BlogPost;
use App\Models\ContactInquiry;
use App\Models\Media;
use App\Models\Park;
use App\Models\PlayoffBracket;
use App\Models\ScoutingVideo;
use App\Models\Sponsor;
use App\Models\TeamCoach;
use App\Support\SeasonContext;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function __construct(private readonly SeasonContext $seasonContext)
    {
    }

    public function playoffs(): View
    {
        $currentSeason = $this->seasonContext->current();

        $brackets = collect();

        if ($currentSeason) {
            $brackets = PlayoffBracket::query()
                ->with([
                    'seeds.club',
                    'rounds' => fn ($query) => $query->orderBy('round_number'),
                    'rounds.matchups.teamOne',
                    'rounds.matchups.teamTwo',
                    'rounds.matchups.winner',
                ])
                ->where('season', $currentSeason->year)
                ->orderBy('order')
                ->get();
        }

        return view('public.playoffs.index', [
            'brackets' => $brackets,
            'currentSeason' => $currentSeason,
            'title' => 'Playoffs',
        ]);
    }

    public function staff(): View
    {
        $currentSeason = $this->seasonContext->current();

        $staffAssignments = collect();

        if ($currentSeason) {
            $staffAssignments = TeamCoach::query()
                ->with(['club', 'staff'])
                ->where('season', $currentSeason->year)
                ->get()
                ->groupBy(fn (TeamCoach $assignment) => $assignment->club?->name ?: 'League');
        }

        return view('public.content.staff', [
            'currentSeason' => $currentSeason,
            'staffAssignments' => $staffAssignments,
            'title' => 'Staff',
        ]);
    }

    public function sponsors(): View
    {
        $sponsors = Sponsor::query()->orderBy('sponsor_level')->orderBy('name')->get()->groupBy('sponsor_level');

        return view('public.content.sponsors', [
            'currentSeason' => $this->seasonContext->current(),
            'sponsors' => $sponsors,
            'title' => 'Sponsors',
        ]);
    }

    public function sponsorshipOpportunities(): View
    {
        return $this->staticPage(
            'Sponsorship Opportunities',
            'Partner With The League',
            'Support the league through sponsor visibility on club pages, league content, and event coverage.',
            [
                'Branding on high-traffic league pages and season hubs.',
                'Recognition across schedule, standings, and media surfaces.',
                'Custom partnership positioning for league events and player coverage.',
            ],
        );
    }

    public function sponsorshipPacket(): View
    {
        return $this->staticPage(
            'Sponsorship Packet',
            'League Sponsorship Packet',
            'A production packet page can later be wired to downloadable collateral or a hosted PDF while preserving the URL.',
            [
                'League audience and season context.',
                'Placement options for digital and event inventory.',
                'Contact workflow through the site inquiry form.',
            ],
        );
    }

    public function parks(): View
    {
        $parks = Park::query()->with('fields')->orderBy('name')->get();

        return view('public.content.parks', [
            'currentSeason' => $this->seasonContext->current(),
            'parks' => $parks,
            'title' => 'Parks',
        ]);
    }

    public function about(): View
    {
        return $this->staticPage(
            'About',
            'About KCCBL',
            'This rebuild preserves the original league product structure: club branding, season context, public stats, roster history, and content coverage.',
            [
                'Season-aware public experience driven by the active season table.',
                'Club-first identity with historical team views and printable schedules.',
                'Data-dense baseball pages spanning standings, stats, awards, and media.',
            ],
        );
    }

    public function awards(): View
    {
        $awards = Award::query()
            ->with(['awardedPlayers.player'])
            ->orderBy('award_name')
            ->get();

        return view('public.content.awards', [
            'awards' => $awards,
            'currentSeason' => $this->seasonContext->current(),
            'title' => 'Awards',
        ]);
    }

    public function allstars(): View
    {
        $awards = Award::query()
            ->with(['awardedPlayers.player'])
            ->orderBy('award_name')
            ->get()
            ->filter(fn (Award $award) => str_contains(strtolower($award->award_name), 'star'));

        if ($awards->isEmpty()) {
            $awards = Award::query()->with(['awardedPlayers.player'])->orderBy('award_name')->get();
        }

        return view('public.content.awards', [
            'awards' => $awards,
            'currentSeason' => $this->seasonContext->current(),
            'title' => 'All-Stars',
        ]);
    }

    public function newsIndex(): View
    {
        $posts = BlogPost::query()->orderByDesc('pinned')->orderByDesc('created_at')->paginate(12);

        return view('public.news.index', [
            'currentSeason' => $this->seasonContext->current(),
            'posts' => $posts,
            'title' => 'News',
        ]);
    }

    public function newsShow(string $slug): View
    {
        $post = BlogPost::query()->where('slug', $slug)->firstOrFail();

        return view('public.news.show', [
            'currentSeason' => $this->seasonContext->current(),
            'post' => $post,
            'title' => $post->title,
        ]);
    }

    public function media(): View
    {
        $media = Media::query()->orderByDesc('uploaded_at')->paginate(18);

        return view('public.media.index', [
            'currentSeason' => $this->seasonContext->current(),
            'items' => $media,
            'title' => 'Media',
        ]);
    }

    public function scoutingVideos(): View
    {
        $videos = ScoutingVideo::query()->with('player')->orderByDesc('featured')->orderByDesc('post_date')->paginate(15);

        return view('public.videos.index', [
            'currentSeason' => $this->seasonContext->current(),
            'title' => 'Scouting Videos',
            'videos' => $videos,
        ]);
    }

    public function contact(): View
    {
        return view('public.content.contact', [
            'currentSeason' => $this->seasonContext->current(),
            'title' => 'Contact',
        ]);
    }

    public function submitContact(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:255'],
            'inquiry_type' => ['required', 'string', 'max:255'],
            'subject' => ['required', 'string', 'max:255'],
            'message' => ['required', 'string'],
        ]);

        ContactInquiry::query()->create([
            ...$validated,
            'ip_address' => $request->ip(),
            'user_id' => $request->user()?->id,
        ]);

        return redirect()->route('contact.show')->with('status', 'Your inquiry has been submitted.');
    }

    public function terms(): View
    {
        return $this->staticPage(
            'Terms',
            'Terms',
            'These terms act as the public legal placeholder for the rebuilt KCCBL site and preserve the original URL footprint.',
            [
                'Use of public schedule, statistics, and content pages.',
                'Reasonable behavior for forms and internal access requests.',
                'League control over content, media, and published records.',
            ],
        );
    }

    public function privacy(): View
    {
        return $this->staticPage(
            'Privacy',
            'Privacy',
            'The rebuilt site stores contact inquiries and authenticated account data using the legacy-backed application schema.',
            [
                'Basic inquiry details and account information are retained for league operations.',
                'Internal role-based tools remain restricted to authorized staff, players, coaches, and admins.',
                'Operational diagnostics endpoints expose compatibility data, not sensitive user content.',
            ],
        );
    }

    public function safariDiagnostics(): View
    {
        return $this->staticPage(
            'Safari Diagnostics',
            'Safari Diagnostics',
            'Compatibility support endpoint preserved for browser troubleshooting and support workflows.',
            [
                'Confirm script and stylesheet load behavior.',
                'Verify browser capabilities against the rebuilt Blade application.',
                'Provide a stable public support URL for client-side diagnostics.',
            ],
        );
    }

    private function staticPage(string $title, string $heading, string $intro, array $bullets): View
    {
        return view('public.content.static', [
            'bullets' => $bullets,
            'currentSeason' => $this->seasonContext->current(),
            'heading' => $heading,
            'intro' => $intro,
            'title' => $title,
        ]);
    }
}