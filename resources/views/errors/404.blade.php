<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    {{-- Set the title --}}
    <title>
        {{ $props ? ($props['seo_title'] . ' - Exposia') : 'Exposia' }}
    </title>

    {{-- Set the meta tags --}}
    <meta name="keywords" content="Exposia">
    <meta name="description" content="Exposia">
    <meta name="robots" content="all">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>

    {{-- Set meta tags for mobile devices --}}
    <meta content="telephone=no" name="format-detection">
    <meta name="apple-mobile-web-app-capable" content="yes"/>

    {{-- Include favicon, touch icons, etc. (for SEO purposes) --}}
    <link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico">
    <link rel="apple-touch-icon" sizes="180x180" href="img/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="img/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="img/favicon/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">

    {{-- Include the external stylesheets (Icons, Fonts, etc.) --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@2.47.0/tabler-icons.min.css">

    {{-- Include the CSS and JS files --}}
    <link href="{{ asset('css/app.css') }}" type="text/css" rel="stylesheet">
    <script src="{{ asset('js/app.js') }}" defer></script>
</head>
<body>

{{-- Include the menu component --}}
<x-menu slug="{{ $slug }}"/>

<main>
    <h1>
        404 - Page Not Found
    </h1>
</main>

</body>
</html>
