<?php


use Illuminate\Support\Facades\Route;

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

Route::middleware('api')->group(function () {
    Route::resource('/questions', QuestionController::class);
    Route::patch('/questions/statusUpdate/{question}', 'QuestionController@statusUpdate')->name('question.statusUpdate');
    Route::resource('/dimensions', DimensionController::class);
    Route::resource('/developers', DeveloperController::class);
});