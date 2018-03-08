<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Comment;
use App\Events\CommentCreated;
use Validator;

class CommentsController extends Controller {
    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'thread' => 'required|exists:threads,id',
            'message' => 'required|max:255'
        ]);
    
        if ($validator->fails()) {
            return response()->json([], 400);
        }
    
        $ip = $request->ip();
    
        if (omment::where('ip', $ip)->where('created_at', '>=', date('Y-m-d H:i:s', strtotime('-10 seconds')))->count() > 0) {
            return response()->json([], 429);
        }
    
        $comment = new Comment;
    
        $comment->ip = $ip;
        $comment->thread_id = $request->post('thread');
        $comment->message = $request->post('message');
    
        $comment->save();
    
        event(new CommentCreated($comment->thread->id, $comment->id, $comment->created_at, $comment->message));
    
        return 1;
    }
}
