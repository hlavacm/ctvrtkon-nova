<?php

namespace App\Nova\Metrics;

use App\Models\User;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Metrics\Partition;

class UsersPerRole extends Partition
{
    public function calculate(NovaRequest $request)
    {
        return $this->count($request, User::class, "role");
    }

    public function cacheFor()
    {
        return now()->addMinutes(5);
    }

    public function uriKey()
    {
        return "users-per-plan";
    }
}
