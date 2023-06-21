<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class proreq extends Model
{
    protected $table = "proreq";
    protected $primarykey = "id";
    protected $fillable = [
        'id', 'nama', 'napro','bukti','deadline'
    ];
}
