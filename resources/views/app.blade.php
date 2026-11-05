<!DOCTYPE html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @php
            $m = $meta ?? [
                'titre'       => config('app.name'),
                'description' => 'Description par défaut du site',
                'image'       => asset('images/og-default.jpg'),
                'url'         => url()->current(),
                'type'        => 'website',
            ];
        @endphp
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="{{ $m['description'] }}">

        <meta property="og:type" content="{{ $m['type'] }}">
        <meta property="og:site_name" content="{{ config('app.name') }}">
        <meta property="og:title" content="{{ $m['titre'] }}">
        <meta property="og:description" content="{{ $m['description'] }}">
        <meta property="og:url" content="{{ $m['url'] }}">
        <meta property="og:image" content="{{ $m['image'] }}">
        <meta property="og:image:width" content="1200">
        <meta property="og:image:height" content="630">
        <meta property="og:locale" content="fr_FR">
        <meta name="twitter:card" content="summary_large_image">

        <title inertia>{{ $m['titre'] }}</title>

        <!-- Fonts -->
        <link rel="icon" type="image/png" href="{{ asset($logoSetting->favicon) }}">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css"/>
        <!-- Scripts -->
        @routes
        @vite(['resources/js/app.js', "resources/js/Pages/{$page['component']}.vue"])
        @inertiaHead
    </head>
    <body class="font-sans antialiased">
        @inertia
    </body>
</html>
