<?php

namespace App\Providers;

use App\Enums\UserRole;
use App\Services\MailchimpNewsletter;
use App\Services\NewsletterInterface;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use MailchimpMarketing\ApiClient;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        app()->bind(NewsletterInterface::class, function (){
            $client = (new ApiClient())->setConfig([
               'apiKey' => config('services.mailchimp.key'),
               'server' => 'us14'
            ]);
            return new MailchimpNewsletter($client);
        });
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

        Blade::if('subscribed', function (NewsletterInterface $newsletter){
            $email = request()->user()?->email;
            if (!empty($email)) {
                return Cache::rememberForever('subscribed_' . md5($email), function () use ($newsletter, $email) {
                    try {
                        $newsletterUser = $newsletter->getListMember(md5($email));
                        if($newsletterUser->status === 'subscribed') {
                            return true;
                        }
                    } catch (\Exception $e) {
                    }
                    return false;
                });
            }

            return false;
        });

        Gate::define('admin', function (User $user){
            return $user->role === UserRole::ADMIN->value;
        });
    }
}
