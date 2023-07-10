<?php

namespace App\Models;

use App\Models\Proreq;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Bank extends Model
{
    use HasFactory;

    protected $table = 'bank';
    protected $primaryKey = 'id';
    protected $fillable = ['nama', 'rekening'];

    public function proreq()
{
    return $this->belongsTo(Proreq::class, 'id');
}
}
