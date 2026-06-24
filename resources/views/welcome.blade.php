<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>SLV-Admin</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        <!-- Styles -->
        @vite('resources/css/app.css')
        <!-- <link rel="stylesheet" href="{{ asset('css/app.css') }}"> -->
    </head>
    <body class="antialiased font-sans">
        <div class="bg-[#3ea7e0]">
            <div class="relative min-h-screen flex flex-col items-center justify-center">
                    <header class="items-center w-full">
                        <div class="flex lg:justify-right text-center">
                             @if (Route::has('login'))
                            <livewire:welcome.navigation />
                            @endif
                        </div>
                    </header>
                    

                    <main class="mt-4 border-1-red">
                        <div class="text-center">
                            <img id="" class="max-w-[877px] m-auto" src="{{ asset('img/slv-logo_512x119.png') }}" />
                        </div>
                    </main>

                    <footer class="py-5 text-center text-sm text-white dark:text-white/70">
                        SLV v<?php echo e(config('app.APP_VERSION')); ?> &copy; 2026. All rights reserved.
                    </footer>
                </div>
            </div>
        </div>
    </body>
    <?php //<script src="{{ asset('js/app.js') }}" defer></script> ?>
</html>
