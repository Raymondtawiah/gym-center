<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\Auth\CustomLoginController;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Laravel\Fortify\Fortify;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Fortify\Events\Login;

use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Log;

class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Register custom RegisteredUserController
        $this->app->singleton(\Laravel\Fortify\Contracts\RegisterResponse::class, RegisteredUserController::class);
        
        // Register custom login controller
        $this->app->singleton(\Laravel\Fortify\Contracts\LoginResponse::class, CustomLoginController::class);
        
        // Register custom authenticated session response
        $this->app->singleton(\Laravel\Fortify\Contracts\AuthenticatedSessionResponse::class, function ($app) {
            return new class($app['url']) implements \Laravel\Fortify\Contracts\AuthenticatedSessionResponse {
                protected $urlGenerator;
                
                public function __construct($urlGenerator)
                {
                    $this->urlGenerator = $urlGenerator;
                }
                
                public function toResponse($request)
                {
                    // Check if verification is required
                    if ($request->session()->get('require_verification', false)) {
                        // Redirect to verification page
                        return redirect()->route('login.verify');
                    }
                    
                    // Default redirect to dashboard
                    return redirect()->intended('/dashboard');
                }
            };
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Set redirect path after login - will be overridden by custom response for verification
        Fortify::redirects('login', '/dashboard');
        
        // Use custom registration controller to redirect to login
        Fortify::registerView(fn () => view('auth.register'));
        
        // Listen for Fortify login event to handle post-login verification
        Event::listen(Login::class, function ($event) {
            $user = $event->user;
            
            // Debug logging
            Log::info('Login event triggered for user: ' . $user->email);
            
            // Get gym name
            $gymName = 'GymCenter';
            if ($user->gym) {
                $gymName = $user->gym->name;
            }
            
            // Generate and send verification code to all users
            $code = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
            
            // Store in session
            session(['verification_code' => $code]);
            session(['verification_code_expires' => now()->addMinutes(10)]);
            session(['verification_user_id' => $user->id]);
            
            // Log the code for debugging (when using log mail driver)
            Log::info('Verification code generated: ' . $code . ' for user: ' . $user->email);
            
            // Send notification
            $user->notify(new \App\Notifications\LoginVerificationNotification($gymName, $code));
            
            // Redirect to verification (will be handled by the response)
            session(['require_verification' => true]);
        });
        
        $this->configureActions();
        $this->configureViews();
        $this->configureRateLimiting();
    }

    /**
     * Configure Fortify actions.
     */
    private function configureActions(): void
    {
        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);
        Fortify::createUsersUsing(CreateNewUser::class);
    }

    /**
     * Configure Fortify views.
     */
    private function configureViews(): void
    {
        $viewsPath = base_path('resources/views/pages');
        
        Fortify::loginView(fn () => view($viewsPath . '/auth/login.blade.php'));
        Fortify::verifyEmailView(fn () => view($viewsPath . '/auth/verify-email.blade.php'));
        Fortify::twoFactorChallengeView(fn () => view($viewsPath . '/auth/two-factor-challenge.blade.php'));
        Fortify::confirmPasswordView(fn () => view($viewsPath . '/auth/confirm-password.blade.php'));
        Fortify::registerView(fn () => view($viewsPath . '/auth/register.blade.php'));
        Fortify::resetPasswordView(fn () => view($viewsPath . '/auth/reset-password.blade.php'));
        Fortify::requestPasswordResetLinkView(fn () => view($viewsPath . '/auth/forgot-password.blade.php'));
    }

    /**
     * Configure rate limiting.
     */
    private function configureRateLimiting(): void
    {
        RateLimiter::for('two-factor', function (Request $request) {
            return Limit::perMinute(5)->by($request->session()->get('login.id'));
        });

        RateLimiter::for('login', function (Request $request) {
            $throttleKey = Str::transliterate(Str::lower($request->input(Fortify::username())).'|'.$request->ip());

            return Limit::perMinute(5)->by($throttleKey);
        });
    }
}
