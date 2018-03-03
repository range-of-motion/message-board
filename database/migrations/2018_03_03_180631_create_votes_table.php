<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVotesTable extends Migration {
    public function up() {
        Schema::create('votes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ip');
            $table->integer('voteable_id')->unsigned();
            $table->string('voteable_type');
            $table->integer('type');
        });
    }

    public function down() {
        Schema::dropIfExists('votes');
    }
}
