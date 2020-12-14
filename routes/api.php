<?php

use Illuminate\Support\Facades\Route;

Route::get('/{resource}/dynamic-fields', '\TuneZilla\DynamicActionFields\DynamicFieldsController@show');
