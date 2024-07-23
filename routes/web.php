<?php

use App\Http\Controllers\AppController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::controller(AppController::class)->group(function () {
    Route::get('/', 'index')->name('app.index');
    Route::get('/game/{id}', 'game')->name('app.game');
    Route::get('/endGame', 'endGame')->name('app.endgame');
    Route::get('/score/{score}', 'score')->name('app.score');

    Route::get('/getQuestions', 'getQuestions')->name('app.getQuestions');
});


