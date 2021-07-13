<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{

    protected $fillable = [
        'content',
        'pomgo_id',
        'user_id',
        'image',
    ];

    public function pomgo() {
        return $this->belongsTo(Pomgo::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}
