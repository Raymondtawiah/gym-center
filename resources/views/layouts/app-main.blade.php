<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        @include('partials.head')
        <title>{{ $title ?? 'GymCenter' }}</title>
    </head>
    <body class="min-h-screen bg-zinc-950 text-white antialiased">
        @include('components.toast')

        <div class="min-h-screen flex flex-col">
            <x-navbar />

            <main class="flex-1">
                {{ $slot }}
            </main>

            <footer class="border-t border-zinc-800 py-6">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex flex-col sm:flex-row items-center justify-between gap-4">
                        <div class="flex items-center gap-2">
                            <div class="w-6 h-6 bg-green-600 rounded flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                                </svg>
                            </div>
                            <span class="text-sm text-zinc-400">GymCenter</span>
                        </div>
                        <p class="text-xs text-zinc-500">&copy; {{ date('Y') }} GymCenter. All rights reserved.</p>
                    </div>
                </div>
            </footer>
        </div>

        @fluxScripts
    </body>
</html>
