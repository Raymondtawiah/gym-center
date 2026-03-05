<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        @include('partials.head')
        <title>Terms and Conditions - GymCenter</title>
    </head>
    <body class="min-h-screen bg-neutral-100 antialiased dark:bg-linear-to-b dark:from-neutral-950 dark:to-neutral-900">
        <div class="min-h-screen">
            <!-- Header -->
            <header class="bg-zinc-900/95 backdrop-blur-sm border-b border-zinc-800 sticky top-0 z-50">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex items-center justify-between h-16">
                        <!-- Logo -->
                        <a href="{{ route('home') }}" class="flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                            </svg>
                            <span class="text-xl font-bold text-white">GymCenter</span>
                        </a>
                        
                        <!-- Navigation -->
                        <nav class="hidden md:flex items-center gap-6">
                            <a href="{{ route('home') }}" class="text-zinc-300 hover:text-white transition-colors">Home</a>
                            <a href="{{ route('classes') }}" class="text-zinc-300 hover:text-white transition-colors">Classes</a>
                            <a href="{{ route('client.register') }}" class="text-zinc-300 hover:text-white transition-colors">Join Now</a>
                        </nav>
                        
                        <!-- Auth Buttons -->
                        <div class="flex items-center gap-3">
                            @auth
                                <a href="{{ route('dashboard') }}" class="px-4 py-2 bg-green-600 hover:bg-green-500 text-white font-medium rounded-lg transition-colors">
                                    Dashboard
                                </a>
                            @else
                                <a href="{{ route('login') }}" class="text-zinc-300 hover:text-white transition-colors">Log in</a>
                                <a href="{{ route('client.register') }}" class="px-4 py-2 bg-green-600 hover:bg-green-500 text-white font-medium rounded-lg transition-colors">
                                    Join Now
                                </a>
                            @endauth
                        </div>
                    </div>
                </div>
            </header>

            <!-- Main Content -->
            <main class="py-12">
                <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
                    <!-- Back Link -->
                    <a href="{{ route('client.register') }}" class="inline-flex items-center gap-2 text-zinc-400 hover:text-white mb-8 transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        Back to Registration
                    </a>
                    
                    <!-- Page Header -->
                    <div class="text-center mb-12">
                        <h1 class="text-4xl font-bold text-white mb-4">Terms and Conditions</h1>
                        <p class="text-zinc-400">
                            Please read our terms and conditions carefully before registering as a member.
                        </p>
                        <p class="text-zinc-500 text-sm mt-2">
                            Last updated: <span id="year"></span>
                        </p>
                    </div>

                    <!-- Terms Content -->
                    <div class="bg-white/5 backdrop-blur-sm rounded-xl border border-white/10 p-8">
                        <div class="prose prose-invert max-w-none">
                            <h2 class="text-2xl font-semibold text-white mb-4">1. Membership Agreement</h2>
                            <p class="text-zinc-300 mb-6">
                                By registering as a member of GymCenter, you agree to be bound by these terms and conditions. 
                                This membership is a legal agreement between you and GymCenter.
                            </p>

                            <h2 class="text-2xl font-semibold text-white mb-4">2. Membership Eligibility</h2>
                            <p class="text-zinc-300 mb-6">
                                You must be at least 18 years old to become a member. You must provide accurate and complete 
                                information during registration. All members must complete a health questionnaire before using our facilities.
                            </p>

                            <h2 class="text-2xl font-semibold text-white mb-4">3. Membership Fees</h2>
                            <p class="text-zinc-300 mb-6">
                                Membership fees are billed monthly and are non-refundable. Fees may be subject to change with 
                                30 days' notice. All payments must be made on time to maintain active membership status.
                            </p>

                            <h2 class="text-2xl font-semibold text-white mb-4">4. Facility Usage</h2>
                            <p class="text-zinc-300 mb-6">
                                Members must follow all gym rules and regulations. Proper athletic attire is required at all times. 
                                Members are responsible for their personal belongings. GymCenter is not liable for any loss or damage.
                            </p>

                            <h2 class="text-2xl font-semibold text-white mb-4">5. Class Bookings</h2>
                            <p class="text-zinc-300 mb-6">
                                Class bookings must be made at least 1 hour in advance. Cancellations must be made at least 
                                2 hours before the class start time. Repeated no-shows may result in booking restrictions.
                            </p>

                            <h2 class="text-2xl font-semibold text-white mb-4">6. Health and Safety</h2>
                            <p class="text-zinc-300 mb-6">
                                Members must certify that they are in good physical condition to exercise. Members with 
                                pre-existing medical conditions should consult a physician before using gym facilities. 
                                Report any injuries or accidents to staff immediately.
                            </p>

                            <h2 class="text-2xl font-semibold text-white mb-4">7. Termination</h2>
                            <p class="text-zinc-300 mb-6">
                                GymCenter reserves the right to terminate membership for violation of rules or conduct 
                                that endangers others. Members may cancel their membership with 30 days' written notice.
                            </p>

                            <h2 class="text-2xl font-semibold text-white mb-4">8. Privacy Policy</h2>
                            <p class="text-zinc-300 mb-6">
                                Your personal information will be used for membership administration and communication. 
                                We will not share your information with third parties without your consent, except as required by law.
                            </p>

                            <h2 class="text-2xl font-semibold text-white mb-4">9. Liability Waiver</h2>
                            <p class="text-zinc-300 mb-6">
                                By using our facilities, you acknowledge that exercise involves inherent risks. GymCenter, 
                                its employees, and agents shall not be liable for any injury, loss, or damage arising from 
                                your use of the facilities, except where caused by our negligence.
                            </p>

                            <h2 class="text-2xl font-semibold text-white mb-4">10. Changes to Terms</h2>
                            <p class="text-zinc-300 mb-6">
                                GymCenter reserves the right to modify these terms at any time. Continued membership after 
                                changes constitutes acceptance of the new terms.
                            </p>

                            <div class="mt-8 p-4 bg-green-600/20 border border-green-600 rounded-lg">
                                <p class="text-green-400 font-medium">
                                    By checking the box during registration, you acknowledge that you have read, understood, 
                                    and agree to be bound by these Terms and Conditions.
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Back to Registration -->
                    <div class="mt-8 text-center">
                        <a href="{{ route('client.register') }}" class="inline-block px-6 py-3 bg-green-600 hover:bg-green-500 text-white font-medium rounded-lg transition-colors">
                            I Agree - Register Now
                        </a>
                    </div>
                </div>
            </main>

            <!-- Footer -->
            <footer class="bg-zinc-900 border-t border-zinc-800 py-8">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex flex-col md:flex-row items-center justify-between gap-4">
                        <div class="flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                            </svg>
                            <span class="text-white font-semibold">GymCenter</span>
                        </div>
                        <p class="text-zinc-400 text-sm">
                            © <span id="footer-year"></span> GymCenter. All rights reserved.
                        </p>
                    </div>
                </div>
            </footer>
        </div>
        @fluxScripts
    </body>
    <script>
        document.getElementById('year').textContent = new Date().getFullYear();
        document.getElementById('footer-year').textContent = new Date().getFullYear();
    </script>
</html>
