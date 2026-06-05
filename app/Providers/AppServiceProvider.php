<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Gate;
use App\Models\User;
use App\Policies\CategoryPolicy;
use App\Models\Category;
use App\Models\Admin\SubCategory;
use App\Policies\SubCategoryPolicy;
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
        Paginator::useBootstrapFive();
        Blade::component('admin.layouts.app', 'admin-layout');
        Gate::before(function ($user, $ability) {
            return $user->hasRole('super admin') ? true : null;;
        });
        Gate::define('is-author', function (User $user) {
            return $user->user_type === 'author';
        });
        Gate::policy(Category::class, CategoryPolicy::class);
        Gate::policy(SubCategory::class, SubCategoryPolicy::class);
    }
}
