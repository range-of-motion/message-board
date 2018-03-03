<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vote extends Model {
    public $timestamps = false;

    public function voteable() {
        return $this->morphTo();
    }
}
