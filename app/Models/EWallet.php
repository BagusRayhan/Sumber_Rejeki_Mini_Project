<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EWallet extends Model
{
    use HasFactory;
    
    protected $table = 'ewallet';
    protected $primaryKey = 'id';
    protected $fillable = ['nama', 'qrcode'];
}