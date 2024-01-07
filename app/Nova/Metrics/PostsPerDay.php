<?php

namespace App\Nova\Metrics;

use App\Models\Post;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Metrics\Trend;

class PostsPerDay extends Trend
{
    public function calculate(NovaRequest $request)
    {
        return $this->countByDays($request, Post::class);
    }

    public function ranges()
    {
        return [
            30 => __("30 Days"),
            60 => __("60 Days"),
            90 => __("90 Days"),
        ];
    }

    public function cacheFor()
    {
        // return now()->addMinutes(5);
    }

    public function uriKey()
    {
        return "posts-per-day";
    }
}
