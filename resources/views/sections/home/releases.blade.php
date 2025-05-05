@php /** @var \Illuminate\Database\Eloquent\Collection|\App\Models\Release[] $releases */ @endphp

<section class="section">
    <h2 class="section-title">Latest Releases</h2>
    <div class="releases-grid">
        @foreach(\App\Models\Release::orderBy('created_at','desc')->limit(8)->cursor() as $release)
            <div class="release-card">
                <img
                    src="{{ asset('storage/'.$release->cover_path) }}"
                    alt="{{ $release->title }}"
                    class="release-cover"
                />
                <div class="release-info">
                    <h4 class="release-title">{{ $release->title }}</h4>
                    <p class="release-artist">{{ $release->artist }}</p>
                    <div class="release-links">
                        @if($release->spotify_url)
                            <a href="{{ $release->spotify_url }}"><i class="fab fa-spotify"></i></a>
                        @endif
                        @if($release->soundcloud_url)
                            <a href="{{ $release->soundcloud_url }}"><i class="fab fa-soundcloud"></i></a>
                        @endif
                        @if($release->apple_url)
                            <a href="{{ $release->apple_url }}"><i class="fab fa-apple"></i></a>
                        @endif
                        @if($release->youtube_url)
                            <a href="{{ $release->youtube_url }}"><i class="fab fa-youtube"></i></a>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <div class="view-all">
        <a href="#" class="btn">View All Releases</a>
    </div>
</section>
