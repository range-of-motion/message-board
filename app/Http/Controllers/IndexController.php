<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Thread;

class IndexController extends Controller {
    public function index() {
        $threads = Thread::orderBy('created_at', 'DESC')
            ->with(['comments' => function ($query) {
                $query->orderBy('created_at', 'ASC');
            }])->get();

        return view('index', compact('threads'));
    }
}
