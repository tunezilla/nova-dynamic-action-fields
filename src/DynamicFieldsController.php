<?php

namespace TuneZilla\DynamicActionFields;

use Laravel\Nova\Http\Requests\ActionRequest;

class DynamicFieldsController
{
    public function show(ActionRequest $request)
    {
        // all the magic happens in the route params:
        // {resource}: tells Nova which Resource to use
        // ?resources=1,2: tells Nova which resource IDs
        // ?action=uri-key: tells Nova which action
        return response()->json($request->action());
    }
}
