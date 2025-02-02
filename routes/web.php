<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RouteController;
use App\Http\Controllers\ReportController;


Route::get('/link-storage', function () {
    Artisan::call('storage:link');
});

Route::get('/signout',function(){
    Auth::logout();
    return redirect('/');
});

Route::get('/',[RouteController::class,'index_view']);
Route::get('/signin',[RouteController::class,'signin_view'])->name("signin");
Route::get('/signup',[RouteController::class,'signup_view'])->name("signup");

Route::get('/forgotpassword',[RouteController::class,'forgot_password_view']);
Route::get('/noaccess',[RouteController::class,'noaccess_view']);
Route::get('/reset_password/{id}',[RouteController::class,'reset_password_view']);

Route::post('/signin',[AuthController::class,'signin']);
Route::post('/signup',[AuthController::class,'signup']);
Route::get('/verify/{id}',[AuthController::class,'verify']);


Route::get('/email-verification',[RouteController::class,'email_verification']);
Route::get('/email-verification-faild',[RouteController::class,'email_verification_faild']);
Route::get('/email-verified',[RouteController::class,'email_verified']);

Route::post('/forgot_password',[AuthController::class,'forgot_password']);
Route::post('/reset_password/{id}',[AuthController::class,'reset_password']);

Route::middleware(['auth_middleware'])->group(function () {

    Route::get('/dashboard',[RouteController::class,'dashboard_view']);
    Route::get('dashboard/reports/',[RouteController::class,'dashboard_reports_view']);

    Route::middleware(['user_only_middleware'])->group(function () {

        Route::prefix('dashboard')->group(function () {
            Route::prefix('reports')->group(function () {
                Route::get('/add',[RouteController::class,'dashboard_reports_add_view']);
                Route::get('/edit/{id}',[RouteController::class,'dashboard_reports_edit_view']);

                Route::post('/add',[ReportController::class,'reports_add']);
                Route::get('/delete/{id}',[ReportController::class,'reports_delete']);
                Route::post('/edit/{id}',[ReportController::class,'reports_edit']);
            });
        });
    });

    Route::middleware(['admin_only_middleware'])->group(function () {
        Route::get('dashboard/reports/approve/{id}',[ReportController::class,'reports_approve']);
        Route::post('/dashboard/reports/filter',[ReportController::class,'reports_filter']);
    });


});