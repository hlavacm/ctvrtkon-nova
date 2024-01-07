<?php

namespace App\Nova\Lenses;

use App\Enums\RoleEnum;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Gravatar;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\LensRequest;
use Laravel\Nova\Lenses\Lens;

class NotVerifiedUsers extends Lens
{
    public static function query(LensRequest $request, $query)
    {
        return $request->withOrdering($request->withFilters(
            $query->whereNull("email_verified_at")
            ->where("role", "!=", RoleEnum::ADMIN->value)
        ));
    }

    public function fields(Request $request)
    {
        return [
            Gravatar::make()
                ->maxWidth(50),

            Text::make(__("Name"), "name")
                ->sortable(),

            Text::make(__("E-mail"), "email")
                ->sortable(),
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

    public function actions(Request $request)
    {
        return parent::actions($request);
    }

    public function uriKey()
    {
        return "not-verified-users";
    }
}
