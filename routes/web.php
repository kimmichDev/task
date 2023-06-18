<?php

use App\Http\Controllers\Admin\TaskController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect("/home");
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix("/admin")->middleware("auth")->group(function () {
    Route::resource("task", TaskController::class);
    Route::post("assign/{task}", [TaskController::class, 'assign'])->name('task.assign');
});
