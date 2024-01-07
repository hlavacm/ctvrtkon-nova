<?php

namespace App\Nova;

use App\Enums\RoleEnum;
use App\Nova\Filters\UserRole;
use App\Nova\Lenses\NotVerifiedUsers;
use App\Nova\Lenses\VerifiedUsers;
use App\Nova\Metrics\NewUsers;
use App\Nova\Metrics\UsersPerDay;
use App\Nova\Metrics\UsersPerRole;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\Gravatar;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Password;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;

class User extends Resource
{
    public static $model = \App\Models\User::class;

    public static $group = "Settings";

    public static $title = "name";

    public static $search = [
        "name", "email",
    ];

    public function fields(Request $request)
    {
        return [
            ID::make(__("ID"), "id")
                ->onlyOnDetail(),

            Gravatar::make()
                ->maxWidth(50),

            Text::make(__("Name"), "name")
                ->sortable()
                ->rules("required", "max:255"),

            Text::make(__("E-mail"), "email")
                ->sortable()
                ->rules("required", "email", "max:255")
                ->creationRules("unique:users,email")
                ->updateRules("unique:users,email,{{resourceId}}"),

            Password::make(__("Password"), "password")
                ->onlyOnForms()
                ->creationRules("required", "string", "min:8")
                ->updateRules("nullable", "string", "min:8"),

            Select::make(__("Role"), "role")
                ->sortable()
                ->options(RoleEnum::options()),

            DateTime::make(__("E-mail Verified At"), "email_verified_at")
                ->sortable()
                ->nullable(),

            DateTime::make(__("Created At"), "created_at")
                ->onlyOnDetail(),

            DateTime::make(__("Updated At"), "updated_at")
                ->onlyOnDetail(),

            HasMany::make(__("Posts"), "posts", Post::class),
        ];
    }

    public function cards(Request $request)
    {
        return [
            new NewUsers,
            new UsersPerDay,
            new UsersPerRole,
        ];
    }

    public function filters(Request $request)
    {
        return [
            new UserRole,
        ];
    }

    public function lenses(Request $request)
    {
        return [
            new NotVerifiedUsers,
            new VerifiedUsers,
        ];
    }

    public function actions(Request $request)
    {
        return [];
    }
}
