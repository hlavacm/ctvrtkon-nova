<?php

namespace App\Nova\Filters;

use Illuminate\Http\Request;
use Laravel\Nova\Filters\BooleanFilter;

class PageIsActive extends BooleanFilter
{
    public function apply(Request $request, $query, $value)
    {
        $active = $value["active"] ?? false;
        if ($active) {
            return $query->whereIsActive(true);
        }
        $inactive = $value["inactive"] ?? false;
        if ($inactive) {
            return $query->whereIsActive(false);
        }
        return $query;
    }

    public function options(Request $request)
    {
        return [
            __("Active?") => "active",
            __("Inactive?") => "inactive",
        ];
    }
}
