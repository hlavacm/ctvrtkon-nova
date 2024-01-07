<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsToMany;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;

class Tag extends Resource
{
    public static $model = \App\Models\Tag::class;

    public static $group = "Data";

    public static $title = "title";

    public static $search = [
        "title",
    ];

    public function fields(Request $request)
    {
        return [
            ID::make(__("ID"), "id")
                ->onlyOnDetail(),

            Text::make("title")
                ->sortable()
                ->rules("required", "max:100"),

            DateTime::make(__("Created At"), "created_at")
                ->onlyOnDetail(),

            DateTime::make(__("Updated At"), "updated_at")
                ->onlyOnDetail(),

            BelongsToMany::make(__("Posts"), "posts"),
        ];
    }

    public function cards(Request $request)
    {
        return [];
    }

    public function filters(Request $request)
    {
        return [];
    }

    public function lenses(Request $request)
    {
        return [];
    }

    public function actions(Request $request)
    {
        return [];
    }
}
