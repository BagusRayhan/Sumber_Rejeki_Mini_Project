<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aboutproreq extends Model
{
    use HasFactory;

    protected $table = 'aboutproreqs';
    protected $fillable = ['about'];
}
