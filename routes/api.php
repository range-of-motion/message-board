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

Route::post('/threads', 'API\ThreadsController@store');
Route::post('/comments', 'API\CommentsController@store');

Route::post('/votes', function (Request $request) {
    // VALIDATE

    $ip = $request->ip();
    $target_id = $request->post('target_id');
    $target_type = $request->post('target_type');
    $type = $request->post('type');

    if (\App\Vote::where('ip', $ip)->where('voteable_id', $target_id)->where('voteable_type', 'App\\' . ucfirst($target_type))->count() > 0) {
        return response()->json([], 429);
    }

    $vote = new \App\Vote;

    $vote->ip = $ip;
    $vote->voteable_id = $target_id;
    $vote->voteable_type = 'App\\' . ucfirst($target_type);
    $vote->type = $type;

    $vote->save();

    event(new \App\Events\VoteCountUpdated($target_id, $target_type, $vote->voteable->vote_count));

    return 1;
});
