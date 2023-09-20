<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $table = 'notification';
    protected $fillable = ['role', 'user_id', 'project_id', 'notif', 'deskripsi', 'kategori'];
    public function proreq() {
        $this->belongsTo(Proreq::class, 'id');
    }
}
