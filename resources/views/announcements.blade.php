<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Announcements - Writehub</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.9.4/css/bulma.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

        <link rel="stylesheet" href="{{ asset('css/show.profile.css') }}">
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">
        <link rel="stylesheet" href="{{ asset('css/profile.dropdown.css') }}">
        <link rel="stylesheet" href="{{ asset('css/error-box.css') }}">
        <script type="module" src="{{ asset('js/navbar.js') }}"></script>
        {{-- <script type="module" src="{{ asset('js/show.profile.js') }}"></script> --}}

        @vite(['resources/js/dropdown.js'])
        @vite(['resources/js/searchInput.js'])
    </head>
    <body>
        <!-- Navigation / navbar -->
        <x-navbar user="Auth::user()" />

        <div class="container is-max-desktop">

            <h1 style="margin-top:2rem;" class="title is-4">Announcements</h1>

                @foreach ($broadcasts as $date => $broadcasts)
                    @php
                        $carbon = \Carbon\Carbon::parse($date);

                        if ($carbon->isToday()) {
                            $label = "Today";
                        } elseif ($carbon->isYesterday()) {
                            $label = "Yesterday";
                        } else {
                            $label = $carbon->format('F d, Y'); // Example: November 12, 2025
                        }
                    @endphp

            <h2 class="subtitle is-6 has-text-weight-semibold mt-5">{{ $label }}</h2>


        <div class="box" style="border-radius: 12px;">
            @foreach ($broadcasts as $broadcast)
                <div class="announcement-item" style="padding: 10px 0; border-bottom: 1px solid #eee;">
                    <div class="is-flex is-justify-content-space-between">
                        <div>
                            <p class="has-text-weight-semibold">{{ $broadcast->title }}</p>
                            <p class="has-text-grey is-size-7">{{ $broadcast->message }}</p>
                        </div>
                        <span class="tag is-light">{{ $broadcast->send_at->format('g:i A') }}</span>
                    </div>
                </div>

            @endforeach
        </div>
    @endforeach
    </div>
  </body>
</html>
