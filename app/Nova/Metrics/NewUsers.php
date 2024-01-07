<?php

namespace App\Nova\Metrics;

use App\Models\User;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Metrics\Value;

class NewUsers extends Value
{
    public function calculate(NovaRequest $request)
    {
        return $this->count($request, User::class);
    }

    public function ranges()
    {
        return [
            30 => __("30 Days"),
            60 => __("60 Days"),
            365 => __("365 Days"),
            "TODAY" => __("Today"),
            "MTD" => __("Month To Date"),
            "QTD" => __("Quarter To Date"),
            "YTD" => __("Year To Date"),
        ];
    }

    public function cacheFor()
    {
        // return now()->addMinutes(5);
    }

    public function uriKey()
    {
        return "new-users";
    }
}
