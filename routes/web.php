<?php

use App\Http\Controllers\Auth\ApiLoginController;
use App\Http\Livewire\Login;
use App\Http\Livewire\Register;
use App\Http\Livewire\ShowPosts;
use Illuminate\Support\Facades\Route;

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
    return view('website');
});



// Route::group(['prefix' => '', 'namespace' => "Livewire"], function () {
//     Route::get('/', "ShowPosts");
//     Route::get('/login', "Login");
//     Route::get('/register', "Register");
// });

Route::group( ['prefix'=>'','namespace' => "Controllers" ],function(){
    Route::get('/website','WebsiteController@website');
    Route::get('/test_api', 'Auth\ProfileController@index');
});

Route::get('/admin', function () {
    return view('backend.dashboard');
})->name('admin');

Route::get('/test', function () {
    return view('test');
    // dd(request()->getClientIp());
    // auth()->login($user);
    // dd(
    //     auth()->check(),
    //     $user->roles()->toSql(),
    //     $user->toArray(),
    //     $user->roles()->get()->toArray(),
    //     $user->toArray(),
    //     $user->permissions()->get()->toArray(),
    // );
});

Route::get('/data-reload', function () {
    \Illuminate\Support\Facades\Artisan::call('migrate:fresh', ['--seed' => true]);
    \Illuminate\Support\Facades\Artisan::call('migrate', ['--path' => 'vendor/laravel/passport/database/migrations', '--force' => true]);
    \Illuminate\Support\Facades\Artisan::call('passport:install');
    return redirect()->back();
});

Route::get('/login', function() {
    if(!str_contains($_SERVER["HTTP_ACCEPT"],'text/html,')){
        return response('please login');
    }
    return redirect('/admin');
})->name('login');