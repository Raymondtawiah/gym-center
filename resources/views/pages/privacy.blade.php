<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        @include('partials.head')
        <title>Privacy Policy - GymCenter</title>
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
                        <h1 class="text-4xl font-bold text-white mb-4">Privacy Policy</h1>
                        <p class="text-zinc-400">
                            Your privacy is important to us. This policy explains how we collect, use, and protect your information.
                        </p>
                        <p class="text-zinc-500 text-sm mt-2">
                            Last updated: <span id="year"></span>
                        </p>
                    </div>

                    <!-- Privacy Policy Content -->
                    <div class="bg-white/5 backdrop-blur-sm rounded-xl border border-white/10 p-8">
                        <div class="prose prose-invert max-w-none">
                            <h2 class="text-2xl font-semibold text-white mb-4">1. Information We Collect</h2>
                            <p class="text-zinc-300 mb-6">
                                We collect personal information that you provide to us during registration, including your name, email address, 
                                phone number, date of birth, address, and emergency contact information. We also collect information about 
                                your membership usage and class bookings.
                            </p>

                            <h2 class="text-2xl font-semibold text-white mb-4">2. How We Use Your Information</h2>
                            <p class="text-zinc-300 mb-6">
                                Your information is used to:
                            </p>
                            <ul class="list-disc list-inside text-zinc-300 mb-6 space-y-2">
                                <li>Process and manage your membership</li>
                                <li>Communicate with you about your account and our services</li>
                                <li>Provide you with access to our facilities and classes</li>
                                <li>Send you important updates and notifications</li>
                                <li>Improve our services and member experience</li>
                                <li>Comply with legal obligations</li>
                            </ul>

                            <h2 class="text-2xl font-semibold text-white mb-4">3. Information Sharing</h2>
                            <p class="text-zinc-300 mb-6">
                                We do not sell, trade, or otherwise transfer your personal information to outside parties. We may share 
                                information with trusted service providers who assist us in operating our website and conducting our business, 
                                as long as those parties agree to keep this information confidential.
                            </p>

                            <h2 class="text-2xl font-semibold text-white mb-4">4. Data Security</h2>
                            <p class="text-zinc-300 mb-6">
                                We implement appropriate technical and organizational measures to protect your personal information against 
                                unauthorized access, alteration, disclosure, or destruction. All data is encrypted and stored securely using 
                                industry-standard security protocols.
                            </p>

                            <h2 class="text-2xl font-semibold text-white mb-4">5. Cookies and Tracking Technologies</h2>
                            <p class="text-zinc-300 mb-6">
                                Our website may use cookies and similar tracking technologies to enhance your browsing experience. 
                                You can choose to disable cookies through your browser settings, though this may affect certain features 
                                of our website.
                            </p>

                            <h2 class="text-2xl font-semibold text-white mb-4">6. Your Rights</h2>
                            <p class="text-zinc-300 mb-6">
                                You have the right to:
                            </p>
                            <ul class="list-disc list-inside text-zinc-300 mb-6 space-y-2">
                                <li>Access the personal information we hold about you</li>
                                <li>Request correction of inaccurate data</li>
                                <li>Request deletion of your personal information</li>
                                <li>Object to processing of your data</li>
                                <li>Request restriction of processing</li>
                                <li>Request transfer of your data</li>
                            </ul>

                            <h2 class="text-2xl font-semibold text-white mb-4">7. Data Retention</h2>
                            <p class="text-zinc-300 mb-6">
                                We retain your personal information for as long as your membership is active and for a reasonable period 
                                thereafter to comply with legal obligations, resolve disputes, and enforce our agreements.
                            </p>

                            <h2 class="text-2xl font-semibold text-white mb-4">8. Third-Party Links</h2>
                            <p class="text-zinc-300 mb-6">
                                Our website may contain links to third-party websites. We are not responsible for the privacy practices 
                                or content of these external sites. We encourage you to review the privacy policies of any third-party 
                                websites you visit.
                            </p>

                            <h2 class="text-2xl font-semibold text-white mb-4">9. Children's Privacy</h2>
                            <p class="text-zinc-300 mb-6">
                                Our services are not intended for individuals under the age of 18. We do not knowingly collect personal 
                                information from children. If we become aware that we have collected data from a minor, we will take 
                                steps to delete such information.
                            </p>

                            <h2 class="text-2xl font-semibold text-white mb-4">10. Changes to This Policy</h2>
                            <p class="text-zinc-300 mb-6">
                                We may update this privacy policy from time to time. We will notify you of any material changes by 
                                posting the new policy on this page and updating the "last updated" date. Your continued use of our 
                                services after any changes constitutes acceptance of the new policy.
                            </p>

                            <h2 class="text-2xl font-semibold text-white mb-4">11. Contact Us</h2>
                            <p class="text-zinc-300 mb-6">
                                If you have any questions or concerns about this Privacy Policy, please contact us at:
                            </p>
                            <div class="p-4 bg-green-600/20 border border-green-600 rounded-lg">
                                <p class="text-green-400 font-medium">
                                    GymCenter<br>
                                    Email: privacy@gymcenter.com<br>
                                    Phone: (555) 123-4567
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Back to Registration -->
                    <div class="mt-8 text-center">
                        <a href="{{ route('client.register') }}" class="inline-block px-6 py-3 bg-green-600 hover:bg-green-500 text-white font-medium rounded-lg transition-colors">
                            I Understand - Register Now
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
