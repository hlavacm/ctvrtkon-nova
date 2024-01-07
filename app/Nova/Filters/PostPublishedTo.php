<?php

namespace App\Nova\Filters;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Laravel\Nova\Filters\DateFilter;

class PostPublishedTo extends DateFilter
{
    public function apply(Request $request, $query, $value)
    {
        $value = Carbon::parse($value);
        return $query->where("published_at", "<=", Carbon::parse($value));
    }
}
