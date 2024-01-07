<?php

namespace App\Nova\Filters;

use App\Enums\RoleEnum;
use Illuminate\Http\Request;
use Laravel\Nova\Filters\Filter;

class UserRole extends Filter
{
    public $component = "select-filter";

    public function apply(Request $request, $query, $value)
    {
        return $query->where("role", $value);
    }

    public function options(Request $request)
    {
        return RoleEnum::options();
    }
}
