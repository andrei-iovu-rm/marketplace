<?php

namespace App\Providers;

use App\Enums\UserRole;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
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
        // Blade money directive
        Blade::directive('money', function ($amount) {
            return "<?php echo number_format($amount, 0, ',', '.'); ?>";
        });

        Blade::if('admin', function (){
            return request()->user()?->can('admin');
        });

        Gate::define('admin', function (User $user){
            return $user->role === UserRole::ADMIN->value;
        });
    }
}
