@php /** @var \Illuminate\Database\Eloquent\Collection|\App\Models\Slider[] $slides */ @endphp

<section class="hero">
    <div class="swiper mySwiper h-full">
        <div class="swiper-wrapper h-full">
            @foreach(\App\Models\Slider::orderBy('created_at','desc')->limit(5)->get() as $slide)
                <div class="swiper-slide relative h-full">
                    @if($slide->media_type === 'video')
                        <video class="absolute inset-0 w-full h-full object-cover" autoplay muted loop>
                            <source src="{{ $slide->media_path }}" type="video/mp4">
                        </video>
                    @else
                        <img
                            src="{{ \Illuminate\Support\Facades\Storage::disk('public')->url($slide->media_path) }}"
                            alt="{{ $slide->title }}"
                            class="absolute inset-0 w-full h-full object-cover"
                        />
                    @endif
                    <div class="hero-content relative z-10">
                        <h1>{{ $slide->title }}</h1>
                        <p>{{ $slide->description }}</p>
                        @if($slide->button_text && $slide->button_url)
                            <a href="{{ $slide->button_url }}" class="btn">{{ $slide->button_text }}</a>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
        <div class="swiper-pagination"></div>
    </div>
</section>
@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            new Swiper('.mySwiper', {
                loop: true,
                pagination: { el: '.swiper-pagination', clickable: true },
                navigation: { nextEl: '.swiper-button-next', prevEl: '.swiper-button-prev' },
                autoplay: { delay: 5000 },
            });
        });
    </script>
@endpush
