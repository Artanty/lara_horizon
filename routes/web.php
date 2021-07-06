<?php

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
    return view('welcome');
});

Route::get('/job1', function () {
    App\Jobs\SendMessage::dispatch("Test message");
});

/**
 *  добавляет в таблицу jobs запись
 *  делает отсрочку
 *  выполняет джобу (удаляет из таблицы jobs)
 */
Route::get('/job2', function () {
    $job = new App\Jobs\SendMessage("job2");
    $job->delay(60);
    dispatch($job)->onQueue('myQueue');
});


Route::get('/job_chain', function () {
    App\Jobs\JobTest1::withChain([
        new App\Jobs\JobTest2("step1"),
        new App\Jobs\JobTest3("step2"),
    ])->dispatch("start job");
});


