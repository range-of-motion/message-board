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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/threads', function (Request $request) {
    // TODO VALIDATE

    $thread = new \App\Thread;

    $thread->title = $request->post('title');

    $thread->save();

    event(new \App\Events\ThreadCreated($thread->created_at, $thread->title));

    return 1;
});
