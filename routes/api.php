<?php

use Illuminate\Support\Facades\Route;

Route::get('/actions/{resource}/dynamic-fields', '\TuneZilla\DynamicActionFields\DynamicFieldsController@show');
