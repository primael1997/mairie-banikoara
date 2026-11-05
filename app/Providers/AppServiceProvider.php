<?php

namespace App\Providers;

use App\Models\EmailSetting;
use App\Models\GeneralSetting;
use App\Models\LogoSetting;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Vite;
use Illuminate\Support\ServiceProvider;
use Inertia\Inertia;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::define('access-dashboard', function (User $user) {
            return $user->isAdmin;
        });

        Gate::define('manage-news', function (User $user) {
            return $user->role === 1;
        });

        Vite::prefetch(concurrency: 3);

        $generalSetting = GeneralSetting::first();
        $logoSetting = LogoSetting::first();
        $mailSetting = EmailSetting::first();

        /** Share variable at all view */
        View::composer('*', function($view) use ($generalSetting, $logoSetting, $mailSetting){
            $view->with([
                'settings' => $generalSetting,
                'logoSetting' => $logoSetting,
                'mailSetting' => $mailSetting,
            ]);
        });

        Inertia::share([
            'settings' => $generalSetting,
            'logoSetting' => $logoSetting,
            'mailSetting' => $mailSetting,
        ]);
    }
}
