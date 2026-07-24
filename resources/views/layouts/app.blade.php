<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <link rel="stylesheet" href="{{ asset('css/style.css?v=' . time()) }}">    
    <link rel="stylesheet" href="{{ asset('css/header.css?v=' . time()) }}">
    <link rel="stylesheet" href="{{ asset('css/responsive.css?v=' . time()) }}">

    <!-- Google Fonts: Nunito and Roboto -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <!-- Force Container Widths to fix broken Bootstrap container issue -->
    <style>
        .container {
            width: 100% !important;
            padding-right: 15px !important;
            padding-left: 15px !important;
            margin-right: auto !important;
            margin-left: auto !important;
        }
        @media (min-width: 576px) { .container { max-width: 540px !important; } }
        @media (min-width: 768px) { .container { max-width: 720px !important; } }
        @media (min-width: 992px) { .container { max-width: 960px !important; } }
        @media (min-width: 1200px) { .container { max-width: 1140px !important; } }
        @media (min-width: 1400px) { .container { max-width: 1320px !important; } }
    </style>
    
    <title>Furnio</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Google Fonts: Roboto for Body, Nunito for Headings -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;500;600;700;800&family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <style>
        body, p, span, a, div, li, input, button, textarea, select {
            font-family: 'Roboto', sans-serif !important;
        }
        h1, h2, h3, h4, h5, h6, .h1, .h2, .h3, .h4, .h5, .h6, .page-title, .section-title, .hero-title-shadow {
            font-family: 'Nunito', sans-serif !important;
        }
        /* Ensure font weights look good */
        h1, h2, h3, h4, h5, h6 {
            font-weight: 700 !important;
        }
    </style>

</head>
<body>

    @include('partials.header')

    @yield('content')

    @include('partials.footer')

</body>
</html>