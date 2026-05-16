<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Auth\Notifications\VerifyEmail; 
use Illuminate\Notifications\Messages\MailMessage; 

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        // Memaksa Laravel menggunakan view custom kita
        VerifyEmail::toMailUsing(function (object $notifiable, string $url) {
            return (new MailMessage)
                ->subject("Assalamu'alaikum - Verifikasi Email Masjid Agung Gresik")
                ->view('emails.verify-email', [
                    'url' => $url,
                    'user' => $notifiable,
                ]);
        });
    }
}