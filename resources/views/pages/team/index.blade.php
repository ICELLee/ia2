{{-- resources/views/pages/team.blade.php --}}
@extends('layouts.app')

@section('title', 'ILLEGALACT | Team')
<link rel="stylesheet" href="{{ asset('css/style.css') }}">
@push('styles')
    <link rel="stylesheet" href="{{ asset('css/team.css') }}">
@endpush
@section('content')
    <section class="section">
        <h2 class="section-title">Unser Team</h2>

        <div class="team-controls">
            <div class="search-bar">
                <i class="fas fa-search"></i>
                <input type="text" placeholder="Team durchsuchen..." id="teamSearch">
            </div>

            <div class="sort-filter">
                <span>Sortieren nach:</span>
                <button class="filter-btn active" data-filter="all">Alle</button>
                <button class="filter-btn" data-filter="orga">Orga</button>
                <button class="filter-btn" data-filter="management">Management</button>
                <button class="filter-btn" data-filter="dj">DJ</button>
                <button class="filter-btn" data-filter="lj">LJ</button>
                <button class="filter-btn" data-filter="ton">Tontechnik</button>
            </div>
        </div>

        @php
            $team = \App\Models\TeamMember::with('jobs')
                      ->where('is_visible', true)
                      ->orderBy('name')
                      ->get();
        @endphp

        <div class="team-grid" id="teamContainer">
            @foreach($team as $member)
                <div class="team-card" data-tags="{{ $member->jobs->pluck('name')->join(' ') }}">
                    <img src="{{ asset('storage/'.$member->image_path) }}" class="team-image" alt="">
                    <div class="team-info">
                        <h3 class="team-name">{{ $member->name }}</h3>
                        @if($member->artist_name)
                            <p class="artist-name">{{ $member->artist_name }}</p>
                        @endif
                        <div class="team-tags">
                            @foreach($member->jobs as $job)
                                <span class="team-tag {{ $job->name }}">{{ $job->label }}</span>
                            @endforeach
                        </div>
                        @if($member->email)
                            <p class="team-email">{{ $member->email }}</p>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        // Team Filter und Suche
        document.addEventListener('DOMContentLoaded', function() {
            const filterButtons = document.querySelectorAll('.filter-btn');
            const teamCards = document.querySelectorAll('.team-card');
            const searchInput = document.getElementById('teamSearch');

            // Filter-Funktion
            filterButtons.forEach(button => {
                button.addEventListener('click', function() {
                    // Aktiven Button markieren
                    filterButtons.forEach(btn => btn.classList.remove('active'));
                    this.classList.add('active');

                    const filterValue = this.getAttribute('data-filter');

                    teamCards.forEach(card => {
                        if (filterValue === 'all') {
                            card.style.display = 'block';
                        } else {
                            const tags = card.getAttribute('data-tags');
                            if (tags.includes(filterValue)) {
                                card.style.display = 'block';
                            } else {
                                card.style.display = 'none';
                            }
                        }
                    });
                });
            });

            // Suchfunktion
            searchInput.addEventListener('input', function() {
                const searchTerm = this.value.toLowerCase();

                teamCards.forEach(card => {
                    const name = card.querySelector('.team-name').textContent.toLowerCase();
                    const artist = card.querySelector('.artist-name')?.textContent.toLowerCase() || '';
                    const tags = card.getAttribute('data-tags').toLowerCase();

                    if (name.includes(searchTerm) || artist.includes(searchTerm) || tags.includes(searchTerm)) {
                        card.style.display = 'block';
                    } else {
                        card.style.display = 'none';
                    }
                });
            });
        });
    </script>
@endpush
