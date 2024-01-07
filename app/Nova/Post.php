<?php

namespace App\Nova;

use App\Nova\Filters\PostPublishedFrom;
use App\Nova\Filters\PostPublishedTo;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\BelongsToMany;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Slug;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Fields\Markdown;

class Post extends Resource
{
    public static $model = \App\Models\Post::class;

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

            Markdown::make(__("Content"), "content")
                ->hideFromIndex()
                ->rules("required", "max:50000"),

            DateTime::make("published_at")
                ->sortable()
                ->nullable()
                ->rules("nullable"),

            DateTime::make(__("Created At"), "created_at")
                ->onlyOnDetail(),

            DateTime::make(__("Updated At"), "updated_at")
                ->onlyOnDetail(),

            BelongsTo::make(__("Author"), "author", User::class)
                ->sortable()
                ->nullable(),

            BelongsTo::make(__("Category"), "category", Category::class)
                ->sortable()
                ->nullable(),

            BelongsToMany::make(__("Tags"), "tags"),
        ];
    }

    public function cards(Request $request)
    {
        return [];
    }

    public function filters(Request $request)
    {
        return [
            new PostPublishedFrom,
            new PostPublishedTo,
        ];
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
