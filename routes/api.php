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

Route::post('/comments', function (Request $request) {
    $validator = Validator::make($request->all(), [
        'thread' => 'required|exists:threads,id',
        'message' => 'required|max:255'
    ]);

    if ($validator->fails()) {
        return response()->json([], 400);
    }

    $ip = $request->ip();

    if (\App\Comment::where('ip', $ip)->where('created_at', '>=', date('Y-m-d H:i:s', strtotime('-10 seconds')))->count() > 0) {
        return response()->json([], 429);
    }

    $comment = new \App\Comment;

    $comment->ip = $ip;
    $comment->thread_id = $request->post('thread');
    $comment->message = $request->post('message');

    $comment->save();

    event(new \App\Events\CommentCreated($comment->thread->id, $comment->id, $comment->created_at, $comment->message));

    return 1;
});

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
