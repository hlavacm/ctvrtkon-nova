<?php

namespace App\Nova;

use App\Nova\Actions\DisablePage;
use App\Nova\Actions\EnablePage;
use App\Nova\Filters\PageIsActive;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Markdown;
use Laravel\Nova\Fields\Slug;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;

class Page extends Resource
{
    public static $model = \App\Models\Page::class;

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

            Boolean::make(__("Is Active?"), "is_active")
                ->sortable(),

            DateTime::make(__("Created At"), "created_at")
                ->onlyOnDetail(),

            DateTime::make(__("Updated At"), "updated_at")
                ->onlyOnDetail(),
        ];
    }

    public function cards(Request $request)
    {
        return [];
    }

    public function filters(Request $request)
    {
        return [
            new PageIsActive,
        ];
    }

    public function lenses(Request $request)
    {
        return [];
    }

    public function actions(Request $request)
    {
        return [
            new EnablePage,
            new DisablePage,
        ];
    }
}
