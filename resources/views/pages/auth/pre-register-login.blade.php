<x-layouts::auth :title="__('Pre-Registration Login')">
    <!-- Toast Notifications -->
    @include('components.toast')
    
    <div class="flex flex-col gap-6">
        <x-auth-header :title="__('Pre-Registration Verification')" :description="__('Enter default credentials to begin registration')" />

        <!-- Session Status -->
        <x-auth-session-status class="text-center" :status="session('status')" />

        <div class="bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-lg p-4 mb-2">
            <div class="flex items-start gap-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-600 dark:text-blue-400 mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <p class="text-sm text-blue-700 dark:text-blue-300">
                    To register a new gym, you need authorization. Please log in with the default credentials provided. A verification code will be sent to the owner for approval.
                </p>
            </div>
        </div>

        <form method="POST" action="{{ route('pre-register.login') }}" class="flex flex-col gap-6">
            @csrf

            <!-- Default Email Address -->
            <flux:input
                name="email"
                :label="__('Default Email')"
                value="admin@gymcenter.com"
                type="email"
                required
                autofocus
                autocomplete="email"
                placeholder="admin@gymcenter.com"
            />

            <!-- Default Password -->
            <div class="relative">
                <flux:input
                    name="password"
                    :label="__('Default Password')"
                    type="password"
                    required
                    autocomplete="current-password"
                    :placeholder="__('Enter default password')"
                    viewable
                />
            </div>

            <div class="flex items-center justify-end">
                <flux:button variant="primary" type="submit" class="w-full" data-test="pre-register-login-button">
                    {{ __('Continue to Verification') }}
                </flux:button>
            </div>
        </form>

        <div class="space-x-1 text-sm text-center rtl:space-x-reverse text-zinc-600 dark:text-zinc-400">
            <span>{{ __('Need help?') }}</span>
            <flux:link href="{{ route('home') }}" wire:navigate>{{ __('Back to Home') }}</flux:link>
        </div>
    </div>
</x-layouts::auth>
