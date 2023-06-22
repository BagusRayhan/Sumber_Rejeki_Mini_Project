<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kebijakan extends Model
{
    protected $table = "kebijakans";
    protected $primarykey = "id";
    protected $fillable = [
        'id', 'kebijakan'
    ];
}
