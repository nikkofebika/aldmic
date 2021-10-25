<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model {
	public function user() {
        return $this->belongsTo(User::class, 'created_by');
    }
    public function approvedby() {
        return $this->belongsTo(User::class, 'approved_by');
    }
}