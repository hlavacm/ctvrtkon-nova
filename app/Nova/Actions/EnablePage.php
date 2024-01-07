<?php

namespace App\Nova\Actions;

use App\Models\Page;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;

class EnablePage extends Action
{
    use InteractsWithQueue, Queueable;

    public function handle(ActionFields $fields, Collection $models)
    {
        /** @var Page $model */
        foreach ($models as $model) {
            $model->is_active = true;
            $model->save();
        }
    }

    public function fields()
    {
        return [];
    }
}
