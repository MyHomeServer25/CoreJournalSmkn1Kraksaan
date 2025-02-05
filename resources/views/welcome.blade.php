<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Laravel</title>
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        <style>
            body {
                margin: 0;
                height: 100vh;
                display: flex;
                justify-content: center;
                align-items: center;
                font-family: 'Figtree', sans-serif;
            }
            .logo-container {
                width: 100%;
                height: 100vh;
                display: flex;
                justify-content: center;
                align-items: center;
            }
            .light-logo {
                width: 400px; /* Increased size */
                height: auto;
                opacity: 0.7; /* Medium transparency (0.0 to 1.0) */
            }
            .dark .light-logo {
                opacity: 0.5;
            }
        </style>
    </head>
    <body class="font-sans antialiased dark:bg-black dark:text-white/50">
        <div class="logo-container">
            <img src="{{ asset('smk.png') }}" class="light-logo" alt="SMK Logo" />
        </div>
    </body>
</html>