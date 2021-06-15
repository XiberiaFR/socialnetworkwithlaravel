<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    public function pomgo() {
        return $this->belongsTo(Pomgo::class, 'pomgo_id');
    }

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }
}
