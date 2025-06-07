<?php

namespace App\Providers;

use App\Models\User;
use Carbon\CarbonImmutable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

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
        Model::shouldBeStrict(! app()->isProduction());

        Date::use(CarbonImmutable::class);

        DB::prohibitDestructiveCommands(app()->isProduction());

        Blade::directive('money', function ($amount) {
            return "<?php echo '$' . number_format($amount, 2, '.', ','); ?>";
        });

        Gate::define('viewPulse', function (User $user) {
            return $user->isAdmin();
        });
    }
}
