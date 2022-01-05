<?php

namespace TuneZilla\DynamicActionFields;

use Illuminate\Support\Collection;
use Laravel\Nova\Http\Requests\ActionRequest;

trait DynamicFieldAction
{
    /** @var ActionRequest|null */
    public $actionRequest = null;

    final public function component()
    {
        return 'dynamic-action-field-modal';
    }

    final public function fields()
    {
        /** @var ActionRequest $actionRequest */
        $actionRequest = $this->actionRequest ?? app(ActionRequest::class);

        $models = [];

        if ($actionRequest->has('resources')) {
            $actionRequest->chunks(100, function ($chunkedModels) use (&$models) {
                /** @var \Illuminate\Database\Eloquent\Collection $chunkedModels */
                $models = array_merge($models, $chunkedModels->all());
            });
        }

        return $this->fieldsForModels(collect($models));
    }

    abstract public function fieldsForModels(Collection $models): array;
}
