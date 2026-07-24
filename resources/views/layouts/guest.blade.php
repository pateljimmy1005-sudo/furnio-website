<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
        
        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

        <!-- Custom Style -->
        <link rel="stylesheet" href="{{ asset('css/style.css?v=' . time()) }}">
    </head>
    <body class="bg-light" style="font-family: 'Poppins', sans-serif;">
        <div class="d-flex align-items-center justify-content-center min-vh-100 px-3">
            <div class="card shadow-lg border-0 rounded-4" style="width: 100%; max-width: 450px;">
                <div class="card-body p-4 p-md-5">
                    <div class="text-center mb-4">
                        <a href="/" class="text-decoration-none">
                            <h2 class="fw-bold m-0 fs-2" style="color: #1A1A1A; font-family: 'Playfair Display', serif; letter-spacing: 2px;">FURNIO</h2>
                        </a>
                    </div>
                    
                    {{ $slot }}
                </div>
            </div>
        </div>
    </body>
</html>
