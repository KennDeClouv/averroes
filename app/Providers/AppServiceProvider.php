<?php

namespace App\Providers;

use Carbon\Carbon;
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
        Carbon::setLocale('id');
        Blade::directive('errorFeedback', function ($field) {
            return "<?php if(\$errors->has($field)): ?>
                        <div class='invalid-feedback'>{{ \$errors->first($field) }}</div>
                    <?php endif; ?>";
        });
        Gate::define('isSuperAdmin', function ($user) {
            return $user->Role->code === 'super_admin';
        });

        Gate::define('isAdministrationAdmin', function ($user) {
            return $user->Role->code === 'administration_admin';
        });

        Gate::define('isTeacher', function ($user) {
            return $user->Role->code === 'teacher';
        });

        Gate::define('isStudent', function ($user) {
            return $user->Role->code === 'student';
        });
        Gate::define('isStudentRegistrant', function ($user) {
            return $user->Role->code === 'student_registrant';
        });
    }
}
