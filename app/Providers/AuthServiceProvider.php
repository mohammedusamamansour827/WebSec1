<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
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

        // ✅ Define a gate for managing users
        Gate::define('manage-users', function (User $user) {
            return $user->isAdmin(); // ✅ Checks the 'admin' boolean
        });

        // ✅ Define a gate for creating products
        Gate::define('create-products', function (User $user) {
            return $user->isAdmin();
        });

        // Add more gates if needed...
        // Admins
    Gate::define('manage-users', function (User $user) {
        return $user->role === 'admin';
    });

    // Instructors
    Gate::define('create-quizzes', function (User $user) {
        return $user->role === 'instructor';
    });

    // Students
    Gate::define('submit-quiz-answer', function (User $user) {
        return $user->role === 'student';
    });
    }
}
