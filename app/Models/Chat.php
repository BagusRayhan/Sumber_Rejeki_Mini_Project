<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    use HasFactory;

    protected $table = 'projectchat';
    protected $fillable = ['user_id', 'project_id', 'chat', 'chat_time'];

    public function proreq() {
        $this->belongsTo(proreq::class, 'id');
    }
}
