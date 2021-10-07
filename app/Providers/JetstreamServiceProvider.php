<?php

namespace App\Providers;

use App\Actions\Jetstream\DeleteUser;
use Illuminate\Support\ServiceProvider;
use Laravel\Jetstream\Jetstream;
use App\Actions\Fortify\AuthenticateLoginAttempt;
use Laravel\Fortify\Fortify;
use Inertia\Inertia;

class JetstreamServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->configurePermissions();

        Jetstream::deleteUsersUsing(DeleteUser::class);

        Fortify::authenticateUsing([new AuthenticateLoginAttempt, '__invoke']);

        Fortify::loginView(function () {
            return Inertia::render('Admin/Auth/Login');
        });

        Fortify::requestPasswordResetLinkView(function () {
            return Inertia::render('Admin/Auth/ForgotPassword', [
                'status' => session('status', '')
            ]);
        });

        Fortify::resetPasswordView(function ($request) {
            return Inertia::render('Admin/Auth/ResetPassword', [
                'email' => $request->email,
                'token' => $request->token
            ]);
        });
    }

    /**
     * Configure the permissions that are available within the application.
     *
     * @return void
     */
    protected function configurePermissions()
    {
        Jetstream::defaultApiTokenPermissions(['read']);

        Jetstream::permissions([
            'create',
            'read',
            'update',
            'delete',
        ]);
    }
}
