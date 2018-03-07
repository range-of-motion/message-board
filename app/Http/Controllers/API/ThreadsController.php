<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Thread;
use App\Events\ThreadCreated;
use Validator;

class ThreadsController extends Controller {
    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:255'
        ]);
    
        if ($validator->fails()) {
            return response()->json([], 400);
        }
    
        $ip = $request->ip();
    
        if (Thread::where('ip', $ip)->where('created_at', '>=', date('Y-m-d H:i:s', strtotime('-1 minute')))->count() > 0) {
            return response()->json([], 429);
        }
    
        $thread = new Thread;
    
        $thread->ip = $ip;
        $thread->title = $request->post('title');
    
        $thread->save();
    
        event(new ThreadCreated($thread->id, $thread->created_at, $thread->title));
    
        return 1;
    }
}
