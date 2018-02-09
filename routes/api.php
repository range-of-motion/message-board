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
    $validator = Validator::make($request->all(), [
        'title' => 'required|max:255'
    ]);

    if ($validator->fails()) {
        return response()->json([], 400);
    }

    $thread = new \App\Thread;

    $thread->ip = $request->ip();
    $thread->title = $request->post('title');

    $thread->save();

    event(new \App\Events\ThreadCreated($thread->id, $thread->created_at, $thread->title));

    return 1;
});

Route::post('/comments', function (Request $request) {
    $validator = Validator::make($request->all(), [
        'thread' => 'required|exists:threads,id',
        'message' => 'required|max:255'
    ]);

    if ($validator->fails()) {
        return response()->json([], 400);
    }

    $comment = new \App\Comment;

    $comment->ip = $request->ip();
    $comment->thread_id = $request->post('thread');
    $comment->message = $request->post('message');

    $comment->save();

    event(new \App\Events\CommentCreated($comment->thread->id, $comment->created_at, $comment->message));

    return 1;
});
