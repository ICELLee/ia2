<!-- Contact Section -->
<section class="section">
    <h2 class="section-title">Contact Us</h2>

    @if(session('success'))
        <div class="alert">{{ session('success') }}</div>
    @endif

    <form
        method="POST"
        action="{{ route('contact.submit') }}"    {{-- named route benutzen --}}
        class="contact-form"
    >
        @csrf

        <div class="form-group">
            <label for="name">Name</label>
            <input
                type="text"
                name="name"
                id="name"
                value="{{ old('name') }}"
                required
                class="form-control"
            />
            @error('name')<p class="error">{{ $message }}</p>@enderror
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input
                type="email"
                name="email"
                id="email"
                value="{{ old('email') }}"
                required
                class="form-control"
            />
            @error('email')<p class="error">{{ $message }}</p>@enderror
        </div>

        <div class="form-group">
            <label for="subject">Subject</label>
            <input
                type="text"
                name="subject"
                id="subject"
                value="{{ old('subject') }}"
                required
                class="form-control"
            />
            @error('subject')<p class="error">{{ $message }}</p>@enderror
        </div>

        <div class="form-group">
            <label for="message">Message</label>
            <textarea
                name="message"
                id="message"
                required
                class="form-control"
            >{{ old('message') }}</textarea>
            @error('message')<p class="error">{{ $message }}</p>@enderror
        </div>

        <button type="submit" class="submit-btn">Send Message</button>
    </form>
</section>
