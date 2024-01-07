<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Slug;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;

class Category extends Resource
{
    public static $model = \App\Models\Category::class;

    public static $group = "Data";

    public static $title = "title";

    public static $search = [
        "title", "description",
    ];

    public function fields(Request $request)
    {
        return [
            ID::make(__("ID"), "id")
                ->onlyOnDetail(),

            Text::make(__("Title"), "title")
                ->sortable()
                ->rules("required", "max:100"),

            Slug::make(__("Slug"), "slug")
                ->from("title")
                ->hideFromIndex()
                ->rules("required", "max:100"),

            Textarea::make(__("Description"), "description")
                ->hideFromIndex()
                ->nullable()
                ->rules("nullable", "max:255"),

            DateTime::make(__("Created At"), "created_at")
                ->onlyOnDetail(),

            DateTime::make(__("Updated At"), "updated_at")
                ->onlyOnDetail(),

            BelongsTo::make(__("Parent"), "parent", Category::class)
                ->sortable()
                ->nullable(),

            HasMany::make(__("Children"), "children", Category::class),
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
