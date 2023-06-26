<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectDisetujui extends Model
{
    use HasFactory;

    protected $table = 'project_disetujui';
    protected $fillable = ['namaclient', 'namaproject', 'progressproject', 'hargaproject', 'dokumenpendukung', 'deadline', 'estimasi'];
}
