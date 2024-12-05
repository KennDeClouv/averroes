<?php

namespace App\Providers;

use App\Models\Role;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

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
        Blade::directive('errorFeedback', function ($field) {
            return "<?php if(\$errors->has($field)): ?>
                        <div class='invalid-feedback'>{{ \$errors->first($field) }}</div>
                    <?php endif; ?>";
        });
        foreach (Role::all() as $role) {
            Gate::define("$role->code", function ($user) use ($role) {
                return $user->Role->code === $role->code;
            });
        }
    }
}
