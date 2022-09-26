<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

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



Auth::routes();

Route::group(['middleware'=>['guest']],function(){

    Route::get('/',function(){
        return view('auth.login');
    });

});


    

Route::group(['prefix' => LaravelLocalization::setLocale()
,'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'auth']], function()
{
	/** ADD ALL LOCALIZED ROUTES INSIDE THIS GROUP **/
    


    // =============================================dashboard============================================
    Route::get('/', function()
	{
        return view('dashboard');

	});

    Route::get('/dashboard', function()
	{
        return view('dashboard');

	});


    // Route::resource('Grades', [App\Http\Controllers\Grade\GradeController::class,'index']);

// =============================================Grades===========================================

    Route::group(['namespace'=>'App\Http\Controllers\Grade'] ,function(){
        Route::resource('Grades', 'GradeController');
    });


    Route::get('/classrooms', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


// =============================================ClassRooms===========================================

        Route::group(['namespace'=>'App\Http\Controllers\Classroom'] ,function(){
            Route::resource('Classrooms', 'ClassroomController');
            Route::post('delete_all', 'ClassroomController@delete_all')->name('delete_all');
        });
    
});



