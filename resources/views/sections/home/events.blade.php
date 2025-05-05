@php /** @var \Illuminate\Database\Eloquent\Collection|\App\Models\Event[] $events */ @endphp

<section class="section">
    <h2 class="section-title">Latest Events</h2>
    <div class="events-grid">
        {{-- Nur eine Schleife, mit limit(10) --}}
        @foreach(\App\Models\Event::with('tags')->orderBy('starts_at','desc')->limit(10)->get() as $event)
            <div class="event-card" data-starts="{{ $event->starts_at->valueOf() }}">
                <img
                    src="{{ asset('storage/'.$event->cover_path) }}"
                    alt="{{ $event->title }}"
                    class="event-image"
                />
                <div class="event-details">
                    <div class="event-date">
                        {{ $event->starts_at->format('d.m.Y') }} • {{ $event->starts_at->format('H:i') }}
                    </div>
                    <h3 class="event-title">{{ $event->title }}</h3>
                    <div class="event-location">
                        <i class="fas fa-map-marker-alt"></i> {{ $event->location }}
                    </div>
                    <div class="event-tags">
                        @foreach($event->tags as $tag)
                            <span class="tag">{{ $tag->name }}</span>
                        @endforeach
                    </div>
                    @if($event->price)
                        <div class="event-price">€{{ $event->price }}</div>
                    @endif

                    {{-- Countdown --}}
                    <div class="countdown">
                        <div class="countdown-item">
                            <div class="countdown-value days">00</div>
                            <div class="countdown-label">Days</div>
                        </div>
                        <div class="countdown-item">
                            <div class="countdown-value hours">00</div>
                            <div class="countdown-label">Hours</div>
                        </div>
                        <div class="countdown-item">
                            <div class="countdown-value minutes">00</div>
                            <div class="countdown-label">Minutes</div>
                        </div>
                        <div class="countdown-item">
                            <div class="countdown-value seconds">00</div>
                            <div class="countdown-label">Seconds</div>
                        </div>
                    </div>

                    @if($event->ticket_url)
                        <a href="{{ $event->ticket_url }}" class="btn">Get Tickets</a>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
    <div class="view-all">
        <a href="{{ \App\Filament\Resources\EventResource::getUrl() }}" class="btn">View All Events</a>
    </div>
</section>

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('.event-card').forEach(function(card) {
                const targetMs = parseInt(card.dataset.starts, 10);
                const daysEl    = card.querySelector('.countdown-value.days');
                const hoursEl   = card.querySelector('.countdown-value.hours');
                const minutesEl = card.querySelector('.countdown-value.minutes');
                const secondsEl = card.querySelector('.countdown-value.seconds');

                function tick() {
                    let delta = targetMs - Date.now();
                    if (delta < 0) delta = 0;
                    const secs = Math.floor(delta / 1000);
                    const days    = Math.floor(secs / 86400);
                    const hours   = Math.floor((secs % 86400) / 3600);
                    const minutes = Math.floor((secs % 3600) / 60);
                    const seconds = secs % 60;

                    daysEl.textContent    = String(days).padStart(2,'0');
                    hoursEl.textContent   = String(hours).padStart(2,'0');
                    minutesEl.textContent = String(minutes).padStart(2,'0');
                    secondsEl.textContent = String(seconds).padStart(2,'0');
                }

                tick();
                setInterval(tick, 1000);
            });
        });
    </script>
@endpush
