<?php

namespace App\Models;

use App\Models\Proreq;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EWallet extends Model
{
    use HasFactory;
    
    protected $table = 'ewallet';
    protected $primaryKey = 'id';
    protected $fillable = ['nama', 'qrcode'];

    public function proreq()
{
    return $this->belongsTo(Proreq::class, 'id');
}
}


