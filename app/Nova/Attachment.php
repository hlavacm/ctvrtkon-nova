<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\File;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Markdown;
use Laravel\Nova\Fields\Text;

class Attachment extends Resource
{
    public static $model = \App\Models\Attachment::class;

    public static $group = "Files";

    public static $title = "name";

    public static $search = [
        "name", "file", "description",
    ];

    public function fields(Request $request)
    {
        return [
            ID::make(__("ID"), "id")
                ->onlyOnDetail(),

            Text::make(__("Name"), "name")
                ->sortable()
                ->exceptOnForms()
                ->rules("required", "max:150"),

            File::make(__("File"), "file")
                ->hideFromIndex()
                ->disk("attachments")
                ->prunable()
                ->storeOriginalName("name")
                ->storeSize("size")
                ->rules("required"),

            Text::make(__("Size"), "size")
                ->sortable()
                ->exceptOnForms()
                ->displayUsing(function ($value) {
                    return number_format($value / 1024, 2) . "kb";
                })
                ->rules("required", "max:105"),

            Markdown::make(__("Description"), "description")
                ->hideFromIndex()
                ->nullable()
                ->rules("max:255"),

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
