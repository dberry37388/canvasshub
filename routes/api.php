<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::apiResource('voters', 'Api\VotersController')
    ->names([
        'index' => 'api.voters.index',
        'show' => 'api.voters.show',
        'store' => 'api.voters.store',
        'update' => 'api.voters.update',
        'destroy' => 'api.voters.destroy'
    ]);

Route::apiResource('votermap', 'Api\VoterMapController')
    ->names([
        'index' => 'api.votermap.index',
    ]);
