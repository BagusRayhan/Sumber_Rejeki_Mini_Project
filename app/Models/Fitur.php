<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fitur extends Model
{
    protected $table = "fitur";
    protected $primarykey = "id";
    protected $fillable = [
        'id', 'project_id','namafitur','hargafitur','biayatambahan','deskripsi','status','status2'
    ];

public function proreq()
{
    return $this->belongsTo(Proreq::class, 'id');
}

}
