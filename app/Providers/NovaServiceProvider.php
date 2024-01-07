<?php

namespace App\Providers;

use App\Enums\RoleEnum;
use App\Nova\Metrics\AttachmentsPerDay;
use App\Nova\Metrics\CategoriesPerDay;
use App\Nova\Metrics\NewAttachments;
use App\Nova\Metrics\NewCategories;
use App\Nova\Metrics\NewPages;
use App\Nova\Metrics\NewPosts;
use App\Nova\Metrics\NewTags;
use App\Nova\Metrics\NewUsers;
use App\Nova\Metrics\PagesPerDay;
use App\Nova\Metrics\PostsPerDay;
use App\Nova\Metrics\TagsPerDay;
use App\Nova\Metrics\UsersPerDay;
use App\Nova\Metrics\UsersPerRole;
use Illuminate\Support\Facades\Gate;
use Laravel\Nova\Nova;
use Laravel\Nova\NovaApplicationServiceProvider;

class NovaServiceProvider extends NovaApplicationServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
    }

    /**
     * Register the Nova routes.
     *
     * @return void
     */
    protected function routes()
    {
        Nova::routes()
            ->withAuthenticationRoutes()
            ->withPasswordResetRoutes()
            ->register();
    }

    /**
     * Register the Nova gate.
     *
     * This gate determines who can access Nova in non-local environments.
     *
     * @return void
     */
    protected function gate()
    {
        Gate::define("viewNova", function ($user) {
            return $user->role === RoleEnum::ADMIN;
        });
    }

    /**
     * Get the cards that should be displayed on the default Nova dashboard.
     *
     * @return array
     */
    protected function cards()
    {
        return [
            new NewPosts,
            new PostsPerDay,
            new NewCategories,
            new CategoriesPerDay,
            new NewTags,
            new TagsPerDay,
            new NewPages,
            new PagesPerDay,
            new NewAttachments,
            new AttachmentsPerDay,
            new NewUsers,
            new UsersPerDay,
            new UsersPerRole,
        ];
    }

    /**
     * Get the extra dashboards that should be displayed on the Nova dashboard.
     *
     * @return array
     */
    protected function dashboards()
    {
        return [];
    }

    /**
     * Get the tools that should be listed in the Nova sidebar.
     *
     * @return array
     */
    public function tools()
    {
        return [];
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
