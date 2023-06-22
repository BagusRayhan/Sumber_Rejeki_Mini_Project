<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fitur extends Model
{
    protected $table = "fitur";
    protected $primarykey = "id";
    protected $fillable = [
        'id', 'namafitur', 'hargafitur','deskripsi','projectid'
    ];
}
