<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')
    ->get('/activate-email/{user}', function (\Illuminate\Http\Request $request) {
        if (! $request->hasValidSignature()) {
            abort(401, 'This link is not valid.');
        }
    
        $request->user()->update([
            'is_activated' => true
        ]);
    
        return redirect(route('home'));
})->name('activate-email');

Route::get('resend-activation-email', 'Auth\RegisterController@resendActivationEmail')->name('activate-resend');

Route::get('not-active', function() {
    return view('not-active');
})->name('not-active');


Auth::routes();

Route::middleware(['auth', 'active'])
    ->group(function() {
        Route::get('/home', 'HomeController@index')->name('home');
        
        Route::group(['prefix' => 'voters'], function() {
            Route::get('/', 'VoterController@index')->name('voters.index');
            Route::get('search', 'VoterController@search')->name('voters.search');
            Route::get('map', 'VoterController@map')->name('voters.map');
            Route::get('{voter}', 'VoterController@show')->name('voters.show');
        });
    });
