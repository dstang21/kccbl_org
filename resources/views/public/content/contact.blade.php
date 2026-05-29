@extends('layouts.app')

@section('content')
    <section class="grid gap-6 xl:grid-cols-[0.8fr_1fr]">
        <div class="card-panel p-6">
            <p class="eyebrow">Get In Touch</p>
            <h1 class="section-title mt-2">Contact</h1>
            <p class="mt-4 text-slate-600">Store public contact requests directly in the legacy `contact_inquiries` table while preserving the public URL.</p>

            <div class="mt-6 space-y-3 text-sm text-slate-600">
                <p>Use the form for general questions, sponsorship follow-up, player access issues, or league operations support.</p>
                <p>Submissions are written to the same inquiry model used by the original site workflow.</p>
            </div>
        </div>

        <div class="card-panel p-6">
            @if (session('status'))
                <div class="mb-6 rounded-[1.5rem] border border-field/20 bg-field/10 px-4 py-3 text-sm font-semibold text-field">
                    {{ session('status') }}
                </div>
            @endif

            <form method="post" action="{{ route('contact.store') }}" class="grid gap-4">
                @csrf
                <div class="grid gap-4 md:grid-cols-2">
                    <label class="space-y-2 text-sm font-semibold text-slate-700">
                        <span>Name</span>
                        <input type="text" name="name" value="{{ old('name') }}" class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 outline-none ring-0 transition focus:border-copper">
                    </label>
                    <label class="space-y-2 text-sm font-semibold text-slate-700">
                        <span>Email</span>
                        <input type="email" name="email" value="{{ old('email') }}" class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 outline-none ring-0 transition focus:border-copper">
                    </label>
                </div>

                <div class="grid gap-4 md:grid-cols-2">
                    <label class="space-y-2 text-sm font-semibold text-slate-700">
                        <span>Phone</span>
                        <input type="text" name="phone" value="{{ old('phone') }}" class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 outline-none ring-0 transition focus:border-copper">
                    </label>
                    <label class="space-y-2 text-sm font-semibold text-slate-700">
                        <span>Inquiry Type</span>
                        <select name="inquiry_type" class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 outline-none transition focus:border-copper">
                            @foreach (['general' => 'General', 'sponsorship' => 'Sponsorship', 'player-access' => 'Player Access', 'support' => 'Support'] as $value => $label)
                                <option value="{{ $value }}" @selected(old('inquiry_type') === $value)>{{ $label }}</option>
                            @endforeach
                        </select>
                    </label>
                </div>

                <label class="space-y-2 text-sm font-semibold text-slate-700">
                    <span>Subject</span>
                    <input type="text" name="subject" value="{{ old('subject') }}" class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 outline-none ring-0 transition focus:border-copper">
                </label>

                <label class="space-y-2 text-sm font-semibold text-slate-700">
                    <span>Message</span>
                    <textarea name="message" rows="7" class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 outline-none ring-0 transition focus:border-copper">{{ old('message') }}</textarea>
                </label>

                @if ($errors->any())
                    <div class="rounded-[1.5rem] border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">
                        {{ $errors->first() }}
                    </div>
                @endif

                <button type="submit" class="inline-flex w-fit items-center justify-center rounded-full bg-ink px-6 py-3 text-sm font-semibold text-white transition hover:bg-slate-900">
                    Submit Inquiry
                </button>
            </form>
        </div>
    </section>
@endsection