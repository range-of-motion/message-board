<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Thread;

class IndexController extends Controller {
    public function index() {
        $threads = Thread::all();

        return view('index', compact('threads'));
    }
}
