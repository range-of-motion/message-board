<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateThreadsTable extends Migration {
    public function up() {
        Schema::create('threads', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('title');
        });
    }

    public function down() {
        Schema::dropIfExists('threads');
    }
}
